<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'meal_type',
        'food_name',
        'calories',
        'proteins',
        'carbohydrates',
        'fats',
        'quantity',
    ];
}
