<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Brigade;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    //Получаем список 
    public function getRoute()
    {
    	$route = Route::where('active', 1)
		    	->get();
		$brigade = Brigade::where('active', 1)
		    	->get();    	


   		return view('route', ['route'=>$route, 'brigade'=>$brigade]); 
    }
//Добавляем 
    public function addRoute(Request $request)
  	{
	    if(!empty($_POST['route'])) 
	    {
	    	$brigade_route = Brigade::where('active',1)
	    				->where('nameBrigade',$request->name_brigade_route)
	    				->first();
	  
		    $route = new Route;

		    $route->route = $request->route;
		    $route->idBrigade = $brigade_route->idBrigade;

		    $route->active = 1;

		    $route->save();
		    return redirect()->route('all-route');
		} 
  }
//Удаляем 
  public function deleteRoute(Request $request){

  	DB::update('update route set active = 0 where idroute = ?', [$request->idRoute]);
  	return redirect()->route('all-route');
  }
}
