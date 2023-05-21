<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    public function index()
    {
        $models = Rental::where("is_active", "=", true)->get();
        return view("Rentals.index", ["models" => $models]);
    }

    public function edit($id)
    {
        $model = Rental::find($id);
        return view("Clients.edit", ["model" => $model]);
    }

    public function update($id, Request $request)
    {
        $model = Rental::find($id);
        $model->client_id = $request->input("client_id");
        $model->car_id = $request->input("car_id");
        $model->rental_date = $request->input("rental_date");
        $model->return_date = $request->input("return_date");
        
        $model->save();
        return redirect("/rentals");
    }

    public function create()
    {
        $model = new Rental();
        return view("Rentals.create", ["model" => $model]);
    }

    public function addToDB(Request $request)
    {
        $model = new Rental();
        $model->client_id = $request->input("client_id");
        $model->car_id = $request->input("car_id");
        $model->rental_date = $request->input("rental_date");
        $model->return_date = $request->input("return_date");
        $model->is_active = true;
        $model->save();
        return redirect("/rentals");
    }
    public function delete($id)
    {
        $model = Rental::find($id);
        $model->is_active = false;
        $model->save();
        return redirect("/rentals");
    }
}
