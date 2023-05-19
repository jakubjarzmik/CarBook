<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        $models = Car::all();
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
}
