@extends('main')

@section('banner')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">Edit Client: {{ $model->first_name }} {{ $model->last_name }}</h1>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="/clients/{{ $model->id }}/update" class="bg-white p-5 contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input name="first_name" type="text" class="form-control" placeholder="First Name" value="{{ $model->first_name }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input name="last_name" type="text" class="form-control" placeholder="Last Name" value="{{ $model->last_name }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="email" type="text" class="form-control" placeholder="E-Mail" value="{{ $model->email }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="phone" type="text" class="form-control" placeholder="Phone Number" value="{{ $model->phone }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" value="Save" class="btn btn-primary py-3 px-5">
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group">
                                <a href="/clients" class="btn btn-danger py-3 px-5">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection