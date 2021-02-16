<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispatchers;
use App\Models\Brigade;
use Illuminate\Support\Facades\DB;

class DispatchersController extends Controller
{
	//Получаем список 
    public function getDispatchers()
    {
    	$dispatchers = Dispatchers::where('active', 1)
		    	->get();
		$brigade = Brigade::where('active', 1)
		    	->get();

   		return view('dispatchers', ['dispatchers'=>$dispatchers, 'brigade'=>$brigade]); 
    }
//Добавляем 
    public function addDispatchers(Request $request)
  	{
	    if(!empty($_POST['nameDispatcher'])) 
	    {
	    	$brigade_dispatchers = Brigade::where('active',1)
	    				->where('nameBrigade',$request->name_brigade_dispatchers)
	    				->first();

		    $dispatchers = new Dispatchers;

		    $dispatchers->nameDispatcher = $request->nameDispatcher;
		    $dispatchers->idBrigade = $brigade_dispatchers->idBrigade;

		    $dispatchers->active = 1;

		    $dispatchers->save();
		    return redirect()->route('all-dispatchers');
		} else {
			echo "заполните данные";
		}
  }
//Удаляем 
  public function deleteDispatchers(Request $request){

  	DB::update('update dispatchers set active = 0 where idDispatcher = ?', [$request->idDispatcher]);
  	return redirect()->route('all-dispatchers');
  }
}
