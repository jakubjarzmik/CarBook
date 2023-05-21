@extends('main')

@section('banner')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <h1 class="mb-3 bread">All Clients</h1>
                <a class="btn btn-primary" href="/clients/create">Create new</a>
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
                <div class="card rounded ftco-animate">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">{{ $model->first_name }} {{ $model->last_name }}</h2>
                            <p class="cat">
                                E-Mail: {{$model->email}} <br>
                                Phone: {{$model->phone}}
                            </p>
                            <p class="d-flex mb-2 d-block">
                                <button type="button" class="btn btn-primary py-2" data-toggle="modal" data-target="#rentals{{$model->first_name}}">Show Rentals</button>
                            </p>
                            <p class="d-flex mb-2 d-block">
                                <a href="{{ url()->current() }}/edit/{{ $model->id }}" class="btn btn-secondary py-2 mr-1">Edit</a>
                                <a href="{{ url()->current() }}/delete/{{ $model->id }}" class="btn btn-danger py-2 ml-1">Delete</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="rentals{{$model->first_name}}" tabindex="-1" role="dialog" aria-labelledby="rentalsLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rentalsLabel">{{ $model->first_name }} {{ $model->last_name }} rentals</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th class="p-1 text-center">Car</th>
                                        <th class="p-1 text-center">Rental date</th>
                                        <th class="p-1 text-center">Return date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($model->rentals as $rental)
                                    <tr>
                                        <td class="p-1">{{$rental->Car->brand}} {{$rental->Car->model}}</td>
                                        <td class="p-1">{{$rental->rental_date}}</td>
                                        <td class="p-1">{{$rental->return_date}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>
@endsection