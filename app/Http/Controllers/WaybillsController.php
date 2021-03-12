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
	    			->where('active', 1)
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

			//Для админа
			$waybillsAdmin = Waybills::where('date', $date)
							->where('active', 1)
	    					->get(); 

			$driversAdmin = Drivers::where('active', 1)
			    	->get();

			$autoAdmin = Auto::where('active', 1)
			    	->get(); 



	   		return view('waybills', ['waybills'=>$waybills, 'brigade'=>$brigade, 'route'=>$route, 'org'=>$org, 'mechanics'=>$mechanics, 'drivers'=>$drivers, 'auto'=>$auto, 'address'=>$address,  'dispatchers'=>$dispatchers, 'typeWB'=>$typeWB,'waybillsAdmin'=>$waybillsAdmin,'driversAdmin'=>$driversAdmin,'autoAdmin'=>$autoAdmin]);
	   	} else {
	   		return view('waybills');
	   	}
    }
//Добавляем Путевые листы
//Добавляем 0 перед числами до 10
    private function addZero($num){
    	if($num<10){
			$num= '0' . $num;
		}
		return $num;
    }

//Формируем серию
    private function addSerialWay($nameBrigade,$date){
		$nameBrigade = $this->addZero($nameBrigade);
		$serial_date = substr_replace(str_replace('.', '', $date),'', 4, 2);
		$serialWay = $serial_date . $nameBrigade;
		$serialWay = $this->addZero($serialWay);
		return $serialWay;
    }

//Формируем номер путевого листа
    private function addNumberWay($date,$idBrigade){
    	$count= Waybills::where('idBrigade', $idBrigade)
	    			->where('date', $date)
			    	->count();

		if($count>0){
			$numberWay = 1+$count;
		} else {
			$numberWay = 1;
		}
		$numberWay = $this->addZero($numberWay);
		return $numberWay;

    }

//Добавялем путевой лист
    public function addWaybills(Request $request)
  	{

	    	for($i=1; $i<=10; $i++) {
	    		if(isset($_POST['checkWaybill' .$i]) && $_POST['checkWaybill' . $i] == 'Yes'){
				    $waybills = new Waybills;
				    $waybills->date = $request->date;
				    //Добавление для админа
				    if(Auth::user()->idRole == 1){
				    	$brigade_admin = Brigade::where('active',1)
				    				->where('nameBrigade',$_POST['name_brigade_admin' .$i])
				    				->first();
				    	//Добавляем серию
				    	$waybills->idBrigade = $brigade_admin->idBrigade;

				    	$waybills->serialWay = $this->addSerialWay($_POST['name_brigade_admin' .$i],$request->date);
			    		//Добавляем номер путевого листа

						$waybills->numberWay = $this->addNumberWay($request->date,$brigade_admin->idBrigade);
						//Добавление для пользотвателей
			    	} else {
				   		$waybills->idBrigade = $request->brigade;

				   		$waybills->serialWay = $this->addSerialWay($request->brigade,$request->date);
			    		//Добавляем номер путевого листа
						$waybills->numberWay = $this->addNumberWay($request->date,$request->brigade);
					}


				    $driver = Drivers::where('active',1)
			    				->where('name',$_POST['name_drivers_waybill' .$i])
			    				->first();
			    	$waybills->idDrivers = $driver->idDrivers;

			    	
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

			    	$route = Route::where('active',1)
			    				->where('idBrigade',$request->brigade)
			    				->first();

			    	$waybills->idroute = $route->idroute;

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
			    	$waybills->active = 1;
				    $waybills->save();
				}
			}
		    return redirect("/waybills/?date={$request->date}");
		
  }
//Удаляем путевой лист
  public function deleteWaybills(Request $request){

  	$idWaybills = $request->idWaybills;
  	$date = $request->date;
  	$waybills = Waybills::where('idWaybills', $idWaybills)
  						->first();
  	$waybills->active = 0;
  	$waybills->save();
  	return redirect("/waybills/?date={$request->date}");
  }
  //Передаем данные для редактирования на страницу редакирования
  public function showEditWaybills(Request $request){
  	$idWaybills = $request->idWaybills;
  	$waybill = Waybills::where('idWaybills', $idWaybills)
  						->where('active', 1)
				    	->first();
	$brigade = $brigade = Brigade::where('active', 1)
				    	->get();
  	if(Auth::user()->idRole == 1){
		$waybills = Waybills::all();  

		

		$drivers = Drivers::where('active', 1)
				    	->get();
		$auto = Auto::where('active', 1)
				    	->get();
  	} else {
	  	$idBrigade = Auth::user()->idBrigade;
		$waybills = Waybills::where('idBrigade', $idBrigade)
				    	->get();  

		$drivers = Drivers::where('active', 1)
						->where('idBrigade', $idBrigade)
				    	->get();
		$auto = Auto::where('active', 1)
						->where('idBrigade', $idBrigade)
				    	->get();
		}
	$typeWB = TypeWB::all();
	
  	return view('editWaybills', ['waybills'=>$waybills, 'waybill'=>$waybill, 'drivers'=>$drivers, 'auto'=>$auto, 'typeWB'=>$typeWB, 'brigade'=>$brigade]);

  }
  //Редактируем выбранный путевой лист
  public function editWaybills(Request $request){
  	$idWaybills = $request->idWaybills;
  	$waybills = Waybills::where('idWaybills', $idWaybills)
  				->first();
  	if(Auth::user()->idRole == 1){
	  	$brigade = Brigade::where('active',1)
				    	->where('nameBrigade',$request->name_brigade_admin)
				    	->first();
		$waybills->idBrigade = $brigade->idBrigade;
	}

  	$driver = Drivers::where('active',1)
			    	->where('name',$request->name_drivers_waybill)
			    	->first();
	$waybills->idDrivers = $driver->idDrivers;

	$auto = Auto::where('active',1)
			    ->where('number',$request->number_auto_waybill)
			    ->first();
	$waybills->idAuto = $auto->idAuto;

	$typeWB = TypeWB::where('type',$request->typeWB)
			    	->first();
	$waybills->idtypeWB = $typeWB->idtypeWB;


  	$waybills->save();

  	return redirect("/waybills/?date={$waybills->date}");

  }
   
}
