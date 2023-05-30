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
                <form method="POST" id="form" action="/cars/create" enctype="multipart/form-data" class="bg-white p-5 contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input name="brand" id="brand" type="text" class="form-control validate" placeholder="Brand" value="{{ $model->brand }}">
                                <span id="brand-error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input name="model" id="model" type="text" class="form-control validate" placeholder="Model" value="{{ $model->model }}">
                                <span id="model-error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="rental_price" id="rental_price" type="number" class="form-control validate" placeholder="Rental Price" value="{{ $model->rental_price }}">
                                <span id="rental_price-error" class="text-danger"></span>
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

@section("scripts")
<script>
    function validateModel(propertyId)
{
    var element = document.getElementById(propertyId);
    var value = element.value;
    $.ajax(
        {
            url: "/cars/validate-model",
            type: "POST",
            dataType: "json",
            data: {
                property: propertyId,
                value: value,
                _token: document.getElementsByName("_token")[0].value
            },

            success: function(data) {
                document.getElementById(propertyId).classList.remove("invalid");
                document.getElementById(propertyId+"-error").innerHTML = "";
            },

            error: function(jqXHR, textStatus, errorThrown) {
                document.getElementById(propertyId).classList.add("invalid");
                document.getElementById(propertyId+"-error").innerHTML = jqXHR.responseJSON.error;
            }
        }
    )
}


    $(document).ready(function() {
        var elems = document.getElementsByClassName("validate");
        for (var i = 0; i < elems.length; i++) {
            var item = elems[i];
            item.addEventListener("change", function(e) {
                validateModel(e.target.id);
            });
        }

        document.getElementById("form").addEventListener("submit", function(e) {
            if (document.getElementsByClassName("invalid").length != 0) {
                e.preventDefault();
            }
        });
    });
</script>



@endsection