<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    protected $table = "rentals";
    protected $primaryKey = "id";

    public function car(){
        return $this->belongsTo(Car::class, "car_id");
    }
    
    public function client(){
        return $this->belongsTo(Client::class, "client_id");
    }
}
