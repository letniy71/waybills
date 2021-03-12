<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drivers;
use App\Models\Brigade;
use Illuminate\Support\Facades\DB;


class DriversController extends Controller
{
    //Получаем список 
    public function getDrivers()
    {
    	$drivers = Drivers::where('active', 1)
		    	->get();
		$brigade = Brigade::where('active', 1)
		    	->get();

   		return view('drivers', ['drivers'=>$drivers, 'brigade'=>$brigade]); 
    }
//Добавляем 
    public function addDrivers(Request $request)
  	{
	    if(!empty($_POST['name']&&$_POST['sertificate'])) 
	    {
	    	$brigade_drivers = Brigade::where('active',1)
	    				->where('nameBrigade',$request->name_brigade_drivers)
	    				->first();

		    $drivers = new Drivers;

		    $drivers->name = $request->name;
		    $drivers->idBrigade = $brigade_drivers->idBrigade;
		    $drivers->sertificate = $request->sertificate;

		    $drivers->active = 1;

		    $drivers->save();
		    return redirect()->route('all-drivers');
		} 
  }
//Удаляем 
  public function deleteDrivers(Request $request){

  	DB::update('update drivers set active = 0 where idDrivers = ?', [$request->idDrivers]);
  	return redirect()->route('all-drivers');
  }
}
