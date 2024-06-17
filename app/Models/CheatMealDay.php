<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheatMealDay extends Model
{
    use HasFactory;

    protected $table = 'cheat_meal_days_v2'; // Especifica la tabla correcta

    protected $fillable = ['patient_id', 'date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
