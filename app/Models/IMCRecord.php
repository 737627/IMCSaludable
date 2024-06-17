<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IMCRecord extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'weight', 'height', 'imc'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
