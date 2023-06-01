<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        if ($request->hasFile('car_image')) {
            $file = $request->file('car_image');
            $extension = $file->getClientOriginalExtension();

            $filename = \Illuminate\Support\Str::slug($model->brand . '-' . $model->model) . '.' . $extension;
            $filePath = 'images/cars/' . $filename;
            $file->move(public_path('images/cars'), $filename);

            $model->image_path = $filePath;
        }

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


        if ($request->hasFile('car_image')) {
            $file = $request->file('car_image');
            $extension = $file->getClientOriginalExtension();

            $filename = \Illuminate\Support\Str::slug($model->brand . '-' . $model->model) . '.' . $extension;
            $filePath = 'images/cars/' . $filename;
            $file->move(public_path('images/cars'), $filename);

            $model->image_path = $filePath;
        }


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

    public function validateModel(Request $request)
    {
        $property = $request->property;
        $value = [$property => $request->value];

        $rules = [
            'brand' => 'required|min:2',
            'model' => 'required|min:2',
            'rental_price' => 'required|numeric|gt:0',
        ];

        $messages = [
            'brand.required' => 'Brand is required.',
            'brand.min' => 'Brand must be at least 2 characters.',
            'model.required' => 'Model is required.',
            'model.min' => 'Model must be at least 2 characters.',
            'rental_price.required' => 'Rental price is required.',
            'rental_price.numeric' => 'Rental price must be numeric.',
            'rental_price.gt' => 'Rental price must be greater than 0.',
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
