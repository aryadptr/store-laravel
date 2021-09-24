@extends('layouts.dashboard')

@section('title')
    Dashboard Create Product
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Create Product</h2>
                <p class="dashboard-subtitle">Create your own product</p>
            </div>
            <div class="dashboard-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('dashboard-products-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" name="name" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="categories_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($category->id == $item->categories_id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="photo">Thumbnail</label>
                                        <input type="file" name="photo" id="photo" class="form-control" />
                                        <p class="text-muted">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-2 ml-auto">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Save Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    </script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor");
    </script>
@endpush
