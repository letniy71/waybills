<?php

namespace App\Http\Controllers;
use App\Models\Auto;
use App\Models\Brigade;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    //Получаем список авто
    public function getAuto()
    {
    	$auto = Auto::where('active', 1)
		    	->get();
		$brigade = Brigade::where('active', 1)
		    	->get();
		//dump($auto);

   		return view('auto', ['auto'=>$auto, 'brigade'=>$brigade]); 
    }


    public function addAuto(Request $request)
  	{
	    if(!empty($_POST['model']&&$_POST['number']&&$_POST['name_brigade_auto'])) 
	    {
	    	$brigade_auto = Brigade::where('active',1)
	    				->where('nameBrigade',$request->name_brigade_auto)
	    				->first();

		    $auto = new Auto;

		    $auto->model = $request->model;
		    $auto->idBrigade = $brigade_auto->idBrigade;
		    $auto->number = $request->number;

		    $auto->active = 1;

		    $auto->save();
		} else {
			echo "заполните данные";
		}
  }
}
