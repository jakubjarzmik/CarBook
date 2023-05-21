<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    protected $table = "cars";
    protected $primaryKey = "id";

    public function rentals()
    {
        return $this->hasMany(Rental::class, "car_id");
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'rentals', 'car_id', 'client_id')
            ->wherePivot('return_date', null);
    }
}
