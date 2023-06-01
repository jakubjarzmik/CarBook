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
    public function search(Request $request)
    {
        $query = $request->input('query');

        $queryParts = explode(' ', $query);

        if (count($queryParts) == 2) {
            $models = Rental::where(function ($q) use ($queryParts) {
                $q->whereHas('client', function ($query) use ($queryParts) {
                    $query->where('first_name', 'like', '%' . $queryParts[0] . '%')
                        ->where('last_name', 'like', '%' . $queryParts[1] . '%');
                })
                    ->orWhereHas('car', function ($query) use ($queryParts) {
                        $query->where('brand', 'like', '%' . $queryParts[0] . '%')
                            ->where('model', 'like', '%' . $queryParts[1] . '%');
                    });
            })
                ->where('is_active', '=', true)
                ->with('client', 'car')
                ->orderBy('rental_date', 'desc')
                ->get();
        } else {
            $models = Rental::where(function ($q) use ($queryParts) {
                $q->whereHas('client', function ($query) use ($queryParts) {
                    $query->where('first_name', 'like', '%' . $queryParts[0] . '%')
                        ->orWhere('last_name', 'like', '%' . $queryParts[0] . '%');
                })
                    ->orWhereHas('car', function ($query) use ($queryParts) {
                        $query->where('brand', 'like', '%' . $queryParts[0] . '%')
                            ->orWhere('model', 'like', '%' . $queryParts[0] . '%');
                    });
            })
                ->where('is_active', '=', true)
                ->with('client', 'car')
                ->orderBy('rental_date', 'desc')
                ->get();
        }

        return response()->json(['models' => $models]);
    }
}
