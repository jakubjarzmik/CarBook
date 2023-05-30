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
                <form method="POST" id="form" action="/clients/{{ $model->id }}/update" class="bg-white p-5 contact-form">
                    @csrf
                    <div class="row">
                    <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input name="first_name" type="text" class="form-control validate" id="first_name" placeholder="First Name" value="{{ $model->first_name }}">
                                <span id="first_name-error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input name="last_name" type="text" class="form-control validate" id="last_name" placeholder="Last Name" value="{{ $model->last_name }}">
                                <span id="last_name-error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="email" type="text" class="form-control validate" id="email" placeholder="E-Mail" value="{{ $model->email }}">
                                <span id="email-error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="phone" type="text" class="form-control validate" id="phone" placeholder="Phone Number" value="{{ $model->phone }}">
                                <span id="phone-error" class="text-danger"></span>
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

@section("scripts")
<script>
    function validateModel(propertyId)
{
    var element = document.getElementById(propertyId);
    var value = element.value;
    $.ajax(
        {
            url: "/clients/validate-model",
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