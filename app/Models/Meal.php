<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'meal_type',
        'description',
        'calories',
        'proteins',
        'carbohydrates',
        'fats',
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'meal_food')->withPivot('quantity');
    }
}
