<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods'; // Aseg�rate de que esta l�nea est� presente

    protected $fillable = [
        'type',
        'name',
        'calories',
        'proteins',
        'carbohydrates',
        'fats',
        'quantity',
        'description',
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_food')->withPivot('quantity');
    }
}
