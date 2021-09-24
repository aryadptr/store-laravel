@extends('layouts.dashboard')

@section('title')
    Dashboard Settings
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Store Settings</h2>
                <p class="dashboard-subtitle">Make store that profitable</p>
            </div>
            <div class="dashboard-content">
                <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="store_name">Store Name</label>
                                        <input type="text" name="store_name" class="form-control"
                                            value="{{ $user->store_name }}" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group" v-if="is_store_open">
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
                                        <label for="store_status">Store Status</label>
                                        <p class="text-muted">
                                            Is your shop currently open?
                                        </p>
                                        <div class=" custom-control custom-radio custom-control-inline">
                                            <input type="radio" name=store_status" id="openStoreTrue"
                                                class="custom-control-input" value="1"
                                                {{ $user->store_status == 1 ? 'checker' : '' }} />
                                            <label for="openStoreTrue" class="custom-control-label">Open</label>
                                        </div>
                                        <div class=" custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="store_status" id="openStoreFalse"
                                                class="custom-control-input" value="0"
                                                {{ $user->store_status == 0 || $user->store_status == null ? 'checker' : '' }} />
                                            <label for="openStoreFalse" class="custom-control-label">Currenty Closed</label>
                                        </div>
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
