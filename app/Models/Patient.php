<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'weight',
        'height',
        'gender',
        'bmi',
        'body_fat_percentage',
        'user_id' 
    ];

    public function diets()
    {
        return $this->hasMany(Diet::class);
    }

    public function cheatMealDay()
    {
        return $this->hasOne(CheatMealDay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
