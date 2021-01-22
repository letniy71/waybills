<?php

namespace App\Http\Controllers;
use App\Movels\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    //Получаем список авто
    public function getAuto()
    {
    	$auto = Auto::where('active', 1)->get();
    						
    	//$auto->brigade->nameBrigade; Допишем в представлении

    	return view('', ['auto'=>$auto]); 
    }
}


SELECT *, brigade.nameBrigade as name_brigade FROM auto LEFT JOIN brigade ON (brigade.idBrigade=auto.idBrigade) WHERE auto.active = 1