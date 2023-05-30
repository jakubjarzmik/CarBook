<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\Rental;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $models = Client::where("is_active", "=", true)->get();
        return view("Clients.index", ["models" => $models]);
    }

    public function edit($id)
    {
        $model = Client::find($id);
        return view("Clients.edit", ["model" => $model]);
    }

    public function update($id, Request $request)
    {
        $model = Client::find($id);
        $model->first_name = $request->input("first_name");
        $model->last_name = $request->input("last_name");
        $model->email = $request->input("email");
        $model->phone = $request->input("phone");
        
        $model->save();
        return redirect("/clients");
    }

    public function create()
    {
        $model = new Client();
        return view("Clients.create", ["model" => $model]);
    }

    public function addToDB(Request $request)
    {
        $model = new Client();
        $model->first_name = $request->input("first_name");
        $model->last_name = $request->input("last_name");
        $model->email = $request->input("email");
        $model->phone = $request->input("phone");
        $model->is_active = true;
        $model->save();
        return redirect("/clients");
    }
    public function delete($id)
    {
        $model = Client::find($id);
        $model->is_active = false;
        $model->save();
        return redirect("/clients");
    }

    public function addRental($id)
    {
        $model = new Rental();
        $model->client_id = $id;
        $cars = Car::where("is_active", "=", true)->where("is_available", "=", true)->get();
        return view("Clients.addRental", ["model"=> $model, "cars"=>$cars]);
    }
    public function addRentalToDB($id, Request $request)
    {
        $model = new Rental();
        $model->rental_date = $request->input("rental_date");
        $model->client_id = $id;

        $carId = $request->input("car_id");
        $model->car_id = $carId;
        $car = Car::find($carId);
        $car->is_available = false;
        $car->save();

        $model->is_active = true;
        $model->save();
        return redirect("/rentals");
    }
}
