<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    public function symptoms()
    {
      return $this->belongsToMany(Symptom::class);  
    }
    public function preventions()
    {
      return $this->belongsToMany(Prevention::class);
    }

}
