<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
  public function evaluations()
  {
    $evaluations=Suggestions::where('type',$request->type);
    return response()->json(['evaluations',$evaluations]); 
  }  
}
