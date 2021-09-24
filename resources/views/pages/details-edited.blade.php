@extends('layouts.app')

@section('title')
    Details - Store
@endsection

@section('content')
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    <a href="/index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item">Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery mb-3" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="" />
                        </transition>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3 col-lg-3 mt-2 mt-lg-3" v-for="(photo, index) in photos"
                                        :key="photo.id" data-aos="zoom-in">
                                        <a href="#" @click="changeActive(index)">
                                            <img :src="photo.url" class="w-100 thumbnail-image"
                                                :class="{ active: index == activePhoto }" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4" data-aos="zoom-in">
                        <div class="store-heading">
                            <h1>{{ $product->name }}</h1>
                            <div class="owner">by {{ $product->user->store_name }}</div>
                            <div class="price">Rp. {{ number_format($product->price, 0, '.', '.') }}</div>
                        </div>
                        <div class="store-description">
                            <div class="title">Description</div>
                            {!! $product->description !!}
                        </div>
                    </div>
                    <div class="col-lg-3" data-aos="zoom-in">
                        <div class="card card-details">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <div class="quantity mb-2">Quantity</div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <button class="btn btn-danger" id="minus" onclick="minus()"><i
                                                        class="fa fa-minus" aria-hidden="true"></i></button>
                                            </div>
                                            <input type="text" id="quantity" min="1" max="9" value="1" disabled
                                                class="form-control text-center col-4"></input>
                                            <div class="col-4">
                                                <button class="btn btn-dark" id="plus" onclick="plus()"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        <div class="stok text-muted">Stock 30</div>
                                        <div class="price" id="price_total">
                                            {{-- {{ number_format($product->price, 0, '.', '.') }} --}}
                                            {{ $product->price }}
                                        </div>
                                        @auth
                                            <form action="{{ route('detail-add', $product->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3">Add
                                                    to
                                                    Cart</button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="btn btn-success px-4 text-white btn-block mb-3">Sign In
                                                to Add</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container" data-aos="fade-up">
            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-3">
                            <h5>Customer Review (3)</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <img src="/images/icon-testimonial-1.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Zahra Nur Umiyah</h5>
                                        I thought it was not good for living room. I really happy
                                        to decided buy this product last week now feels like
                                        homey.
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/icon-testimonial-2.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Maryam Yani</h5>
                                        Color is great with the minimalist concept. Even I thought
                                        it was made by Cactus industry. I do really satisfied with
                                        this.
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/icon-testimonial-3.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Syilviana Marry</h5>
                                        When I saw at first, it was really awesome to have with.
                                        Just let me know if there is another upcoming product like
                                        this.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->galleries as $gallery)
                        {
                        id: {{ $gallery->id }},
                        url: "{{ Storage::url($gallery->photo) }}",
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>
    <script>
        var quantity = 1;
        var quantityEl = document.getElementById("quantity");
        var priceEl = parseInt(document.getElementById("price_total"));

        function plus() {
            quantity++;
            quantityEl.value = quantity;
            priceEl.value = parseInt(quantity) * priceEl;
        }

        function minus() {
            if (quantity > 1) {
                quantity--;
                quantityEl.value = quantity;
                priceEl.value = quantity * priceEl;
            }
        }
    </script>
@endpush
