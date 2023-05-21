@extends('main')

@section('banner')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <h1 class="mb-3 bread">Create car</h1>
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
                <form method="POST" action="/cars/create" enctype="multipart/form-data" class="bg-white p-5 contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input name="brand" type="text" class="form-control" placeholder="Brand" value="{{ $model->brand }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input name="model" type="text" class="form-control" placeholder="Model" value="{{ $model->model }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="rental_price" type="number" class="form-control" placeholder="Rental Price" value="{{ $model->rental_price }}">
                            </div>
                        </div>
                        <div class="col-md-12 py-3">
                            <div class="custom-control custom-switch">
                                <input name="is_available" type="checkbox" class="custom-control-input" id="is_available" {{ $model->is_available == true ? "checked" : "" }}>
                                <label class="custom-control-label" for="is_available">Available</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="car_image">Car Image</label>
                                <input type="file" name="car_image" class="form-control-file" accept="image/png, image/jpeg">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" value="Save" class="btn btn-primary py-3 px-5">
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group">
                                <a href="/cars" class="btn btn-danger py-3 px-5">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection