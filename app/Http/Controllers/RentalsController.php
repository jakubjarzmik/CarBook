<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    public function index()
    {
        $models = Rental::where("is_active", "=", true)->with('client', 'car')->orderBy('rental_date', 'desc')->get();
        return view("Rentals.index", ["models" => $models]);
    }

    public function return($id)
    {
        $model = Rental::find($id);
        $model->return_date = date('Y-m-d');

        $car = Car::find($model->car_id);
        $car->is_available = true;
        $car->save();
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
