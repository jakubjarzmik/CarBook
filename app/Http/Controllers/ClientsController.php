<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $model->rental_date = date('Y-m-d');
        $cars = Car::where("is_active", "=", true)->where("is_available", "=", true)->get();
        return view("Clients.addRental", ["model" => $model, "cars" => $cars]);
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

    public function validateModel(Request $request)
    {
        $property = $request->property;
        $value = [$property => $request->value];

        $rules = [
            'first_name' => 'required|min:2|regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$/',
            'last_name' => 'required|min:2|regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$/',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ];

        $messages = [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 2 characters.',
            'first_name.regex' => 'First name must start with a capital letter.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 2 characters.',
            'last_name.regex' => 'Last name must start with a capital letter.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'phone.required' => 'Phone number is required.',
            'phone.numeric' => 'Phone number must be numeric.',
        ];

        if (array_key_exists($property, $rules)) {
            $validator = Validator::make($value, [$property => $rules[$property]], $messages);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first($property)], 400);
            }
        }

        return response()->json(["error" => ""]);
    }
}
