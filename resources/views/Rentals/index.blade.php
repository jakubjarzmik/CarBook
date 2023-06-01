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
            <input type="text" id="search" class="form-control" placeholder="Search...">
        </div>
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
                            <a href="{{ url()->current() }}/{{ $model->id }}/delete" class="btn btn-danger delete-btn py-2 ml-1">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section("scripts")
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            $.ajax({
                url: '/rentals/search',
                type: 'GET',
                data: { query: $(this).val() },
                success: function(data) {
                    var tbody = '';
                    for (var i = 0; i < data.models.length; i++) {
                        var model = data.models[i];
                        var row = '<tr>';
                        row += '<td>' + model.client.first_name + ' ' + model.client.last_name + '</td>';
                        row += '<td>' + model.car.brand + ' ' + model.car.model + '</td>';
                        row += '<td>' + model.rental_date + '</td>';
                        row += '<td>' + (model.return_date ? model.return_date : '') + '</td>';
                        row += '<td>' +
                                '<a href="/rentals/' + model.id + '/return" class="btn btn-primary py-2 ml-1 ' + (model.return_date != null ? 'disabled' : '') + '">Return car</a>' +
                                '<a href="/rentals/' + model.id + '/delete" class="btn btn-danger py-2 ml-1 delete-btn">Delete</a>' +
                               '</td>';
                        row += '</tr>';
                        tbody += row;
                    }
                    $('table tbody').html(tbody);
                }
            });
        });
    });
</script>



@endsection