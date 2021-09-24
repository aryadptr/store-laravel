@extends('layouts.success')

@section('title')
    Success Register - Store
@endsection

@section('content')
    <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/images/success.svg" alt="" class="mb-4" />
              <h2>Welcome to Store</h2>
              <p>
                You have successfully registered <br />
                with us. Let's grow up now.
              </p>
              <div>
                <a href="/dashboard.html" class="btn btn-success w-50 mt-4"
                  >My Dashboard</a
                >
                <a href="/index.html" class="btn btn-sign-up w-50 mt-2"
                  >Go To Shopping</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection