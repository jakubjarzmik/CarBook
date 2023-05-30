@extends('main')

@section('banner')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <h1 class="mb-3 bread">All Rentals</h1>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Car</th>
                        <th scope="col">Rental date</th>
                        <th scope="col">Return date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($models as $model)
                    <tr>
                        <td>{{ $model->client->first_name }} {{ $model->client->last_name }}</td>
                        <td>{{ $model->car->brand }} {{ $model->car->model }}</td>
                        <td>{{ $model->rental_date }}</td>
                        <td>{{ $model->return_date }}</td>
                        <td>
                            <a href="{{ url()->current() }}/{{ $model->id }}/return" class="btn btn-primary py-2 ml-1 {{$model->return_date!=null ? 'disabled' : ''}}">Return car</a>
                            <a href="{{ url()->current() }}/{{ $model->id }}/delete" class="btn btn-danger py-2 ml-1">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection