<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods'; // Asegúrate de que esta línea está presente

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
