@extends('main')

@section('banner')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <h1 class="mb-3 bread">Add Rental</h1>
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
                <form method="POST" action="/clients/{{$model->client_id}}/add-rental" class="bg-white p-5 contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text">
                                    Car
                                </label>
                                <select name="car_id" class="form-control validate">
                                    @foreach($cars as $car)
                                        <option value="{{$car->id}}" {{$model->car_id == $car->id ? "selected" : ""}}>{{$car->brand}} {{$car->model}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text">
                                    Rental date
                                </label>
                                <input name="rental_date" class="form-control validate" type="date" value="{{ date('Y-m-d', strtotime($model->rental_date)) }}">
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