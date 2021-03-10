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
use App\Models\TypeWB;
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
					->where('idBrigade', $idBrigade)
			    	->get();
			$dispatchers = Dispatchers::where('active', 1)
			    	->get();
			$auto = Auto::where('active', 1)
					->where('idBrigade', $idBrigade)
			    	->get();  
			$address = Address::where('active', 1)
			    	->get(); 
			$typeWB = TypeWB::all();   	


	   		return view('waybills', ['waybills'=>$waybills, 'brigade'=>$brigade, 'route'=>$route, 'org'=>$org, 'mechanics'=>$mechanics, 'drivers'=>$drivers, 'auto'=>$auto, 'address'=>$address,  'dispatchers'=>$dispatchers, 'typeWB'=>$typeWB]);
	   	} else {
	   		return view('waybills');
	   	}
    }
//Добавляем 

    public function addWaybills(Request $request)
  	{

	    	for($i=1; $i<=10; $i++) {
	    		if(isset($_POST['checkWaybill' .$i]) && $_POST['checkWaybill' . $i] == 'Yes'){
				    $waybills = new Waybills;
				    $waybills->date = $request->date;
				    $waybills->idBrigade = $request->brigade;


				    $driver = Drivers::where('active',1)
			    				->where('name',$_POST['name_drivers_waybill' .$i])
			    				->first();
			    	$waybills->idDrivers = $driver->idDrivers;

			    	$waybills->serialWay = 2;
			    	$waybills->numberWay =4;

			    	$auto = Auto::where('active',1)
			    				->where('number',$_POST['number_auto_waybill' .$i])
			    				->first();
			    	$waybills->idAuto = $auto->idAuto;

			    	$dispatcher = Dispatchers::where('active',1)
			    				->where('idBrigade',$request->brigade)
			    				->first();
			    	$waybills->idDispatcher = $dispatcher->idDispatcher;

			    	$mechanic = Mechanics::where('active',1)
			    				->where('idBrigade',$request->brigade)
			    				->first();

			    	$waybills->idMechanics = $mechanic->idMechanics;

			    	$brigade_org = Brigade::where('active',1)
			    				->where('idBrigade',$request->brigade)
			    				->first();
			    	$waybills->idorganization = $brigade_org->idorganization;

			    	$address = Address::where('active',1)
			    				->where('idBrigade',$request->brigade)
			    				->first();
			    	$waybills->idAddress = $address->idAddress;

			    	$typeWB = TypeWB::where('type',$_POST['typeWB' .$i])
			    				->first();
			    	$waybills->idtypeWB = $typeWB->idtypeWB;

				    $waybills->save();
				}
			}
		    return redirect("/waybills/?date={$request->date}");
		
  }
   
}
