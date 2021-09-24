@extends('layouts.auth')

@section('title')
    Register - Store
@endsection

@section('content')

    <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center justify-content-center row-login mt-5">
                    <div class="col-lg-4">
                        <h2>Starting to buy and sell in the newest way</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" v-model="name"
                                    autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id=" email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" @change="checkForAvailability()"
                                    :class="{ 'is-invalid' : this.email_unavailable }" v-model="email" required
                                    autocomplete>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="store">Store</label>
                                <p class="text-muted">Do you also want to open a store?</p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="is_store_open" id="openStoreTrue" class="custom-control-input"
                                        v-model="is_store_open" :value="true" />
                                    <label for="openStoreTrue" class="custom-control-label">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="is_store_open" id="openStoreFalse"
                                        class="custom-control-input" v-model="is_store_open" :value="false" />
                                    <label for="openStoreFalse" class="custom-control-label">No</label>
                                </div>
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label for="store_name">Store Name</label>
                                <input type="text" name="store_name" id="store_name" v-model="store_name"
                                    class="form-control @error('store_name') is-invalid @enderror" name="password" required
                                    autocomplete autofocus />
                                @error('store_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label for="category">Category</label>
                                <select name="categories_id" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-4" :disabled="this.email_unavailable">
                                Sign Up Now
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-sign-up btn-block mt-2">
                                Back to Sign In
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(Toasted);

        var register = new Vue({
            el: "#register",
            mounted() {
                AOS.init();

            },
            methods: {
                checkForAvailability: function() {
                    var self = this;
                    axios.get('{{ route('api-register-check') }}', {
                            params: {
                                email: this.email
                            }
                        })
                        .then(function(response) {

                            if (response.data == 'Available') {
                                self.$toasted.show(
                                    "Your email is available!", {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 1000,
                                    }
                                );
                                self.email_unavailable = false;
                            } else {
                                self.$toasted.error(
                                    "Sorry, it seems that the email is already registered on our system", {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 1000,
                                    }
                                );
                                self.email_unavailable = true;
                            }

                            // handle success
                            console.log(response);
                        });
                }
            },
            data() {
                return {
                    name: "Zahra Nur Umiyah",
                    email: "zahranurumiyah@gmail.com",
                    is_store_open: true,
                    storeName: "",
                    email_unavailable: false
                }
            },
        });
    </script>
@endpush
