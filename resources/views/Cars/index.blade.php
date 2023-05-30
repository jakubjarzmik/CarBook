@extends('main')

@section('banner')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <h1 class="mb-3 bread">All Cars</h1>
                <a class="btn btn-primary" href="/cars/create">Create new</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            @foreach($models as $model)
            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate" data-toggle="{{ $model->clients->isEmpty() ? '' : 'tooltip' }}" title="{{ $model->clients->isEmpty() ? '' : 'Currently rented by ' . $model->clients->first()->first_name . ' ' . $model->clients->first()->last_name }}">
                <div class="img rounded d-flex align-items-end {{ $model->clients->isEmpty() ? '' : 'grayscale' }}" style="background-image: url({{$model->image_path}});">
                    </div>
                    <div class="text">
                        <h2 class="mb-0"><a href="car-single.html">{{ $model->model }}</a></h2>
                        <div class="d-flex mb-3">
                            <span class="cat">{{$model->brand}}</span>
                            <p class="price ml-auto">${{$model->rental_price}} <span>/day</span></p>
                        </div>
                        <p class="d-flex mb-0 d-block">
                            <a href="{{ $model->clients->isEmpty() ? url()->current() . '/' . $model->id . '/edit' : '#' }}" class="btn btn-primary py-2 mr-1 {{ $model->clients->isEmpty() ? '' : 'disabled' }}">Edit</a>
                            <a href="{{ $model->clients->isEmpty() ? url()->current() . '/' . $model->id . '/delete' : '#' }}" class="btn btn-danger py-2 ml-1 {{ $model->clients->isEmpty() ? '' : 'disabled' }}">Delete</a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
@endsection
