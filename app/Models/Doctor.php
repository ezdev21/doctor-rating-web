<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    
    public function previews(){
      return $this->hasMany(preview::class);
    }
    public function users()
    {
      return $this->belongsToMany(User::class);
    }
    public function hospitals()
    {
      return $this->belongsToMany(Hospital::class); 
    }
    public function specialities()
    {
      return $this->belongsToMany(Speciality::class);
    }
    public function languages()
    {
      return $this->belongsToMany(Language::class);
    }
    public function suggestions()
    {
      return $this->morphToMany(Suggestion::class,'suggestionable');
    }  
}
