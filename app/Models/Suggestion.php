<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    public function doctors()
    {
      return $this->belongsToMany(Doctor::class);  
    }
    public function doctors()
    {
      return $this->morphedByMany(Doctor::class,'suggestionable');
    }
    public function hospitals()
    {
     return $this->morphedByMany(Hospital::class,'suggestionable');
    }
}
