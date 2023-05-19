<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
}
