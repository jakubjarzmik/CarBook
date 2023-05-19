<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        $models = Car::where("is_active", "=", true)->get();
        return view("Cars.index", ["models" => $models]);
    }

    public function edit($id)
    {
        $model = Car::find($id);
        return view("Cars.edit", ["model" => $model]);
    }

    public function update($id, Request $request)
    {
        $model = Car::find($id);
        $model->brand = $request->input("brand");
        $model->model = $request->input("model");
        $model->rental_price = $request->input("rental_price");
        $model->is_available = $request->input("is_available") ? true : false;
        
        $model->save();
        return redirect("/cars");
    }

    public function create()
    {
        $model = new Car();
        return view("Cars.create", ["model" => $model]);
    }

    public function addToDB(Request $request)
    {
        $model = new Car();
        $model->brand = $request->input("brand");
        $model->model = $request->input("model");
        $model->rental_price = $request->input("rental_price");
        $model->is_available = $request->input("is_available") ? true : false;
        $model->is_active = true;
        $model->save();
        return redirect("/cars");
    }
    public function delete($id)
    {
        $model = Car::find($id);
        $model->is_active = false;
        $model->save();
        return redirect("/cars");
    }
}
