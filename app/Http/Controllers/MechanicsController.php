<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mechanics;
use App\Models\Brigade;
use Illuminate\Support\Facades\DB;

class MechanicsController extends Controller
{
    //Получаем список 
    public function getMechanics()
    {
    	$mechanics = Mechanics::where('active', 1)
		    	->get();
		$brigade = Brigade::where('active', 1)
		    	->get();

   		return view('mechanics', ['mechanics'=>$mechanics, 'brigade'=>$brigade]); 
    }
//Добавляем 
    public function addMechanics(Request $request)
  	{
	    if(!empty($_POST['nameMechanic'])) 
	    {
	    	$brigade_mechanics = Brigade::where('active',1)
	    				->where('nameBrigade',$request->name_brigade_mechanics)
	    				->first();

		    $mechanics = new Mechanics;

		    $mechanics->nameMechanic = $request->nameMechanic;
		    $mechanics->idBrigade = $brigade_mechanics->idBrigade;

		    $mechanics->active = 1;

		    $mechanics->save();
		    return redirect()->route('all-mechanics');
		} else {
			echo "заполните данные";
		}
  }
//Удаляем 
  public function deleteMechanics(Request $request){

  	DB::update('update mechanics set active = 0 where idMechanics = ?', [$request->idMechanics]);
  	return redirect()->route('all-mechanics');
  }
}
