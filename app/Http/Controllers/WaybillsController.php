<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waybills;
use App\Models\Route;
use App\Models\Brigade;
use App\Models\Organization;
use App\Models\Mechanics;
use App\Models\Drivers;
use App\Models\Dispatchers;
use App\Models\Auto;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Auth;


class WaybillsController extends Controller
{
	
    //Получаем список по дате  бригаде
    public function getWaybills(Request $request)
    {
    	if(!empty($request->date)){

	    	$date = $request->date;

	    	$idBrigade = Auth::user()->idBrigade;
	    	$waybills = Waybills::where('idBrigade', $idBrigade)
	    			->where('date', $date)
			    	->get();    
			$brigade = Brigade::where('active', 1)
			    	->get();
			$route = Route::where('active', 1)
			    	->get();  
			$org = Organization::where('active', 1)
			    	->get();  
			$mechanics = Mechanics::where('active', 1)
			    	->get();  
			$drivers = Drivers::where('active', 1)
			    	->get();
			$dispatchers = Dispatchers::where('active', 1)
			    	->get();
			$auto = Auto::where('active', 1)
			    	->get();  
			$address = Address::where('active', 1)
			    	->get();    	


	   		return view('waybills', ['waybills'=>$waybills, 'brigade'=>$brigade, 'route'=>$route, 'org'=>$org, 'mechanics'=>$mechanics, 'drivers'=>$drivers, 'auto'=>$auto, 'address'=>$address,  'dispatchers'=>$dispatchers]);
	   	} else {
	   		return view('waybills');
	   	}
    }
//Добавляем 
   
}
