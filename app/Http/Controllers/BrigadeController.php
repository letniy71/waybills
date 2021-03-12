<?php

namespace App\Http\Controllers;
use App\Models\Organization;
use App\Models\Brigade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrigadeController extends Controller
{
    //Получаем список 
    public function getBrigade()
    { 
    	$brigade = Brigade::where('active', 1)
		    	->get();
		$org = Organization::where('active', 1)
		    	->get();

   		return view('brigade', ['brigade'=>$brigade,'org'=>$org]); 
    }
//Добавляем 
    public function addBrigade(Request $request)
  	{
	    if(!empty($_POST['nameBrigade'])) 
	    {
	    	$organization_brigade = Organization::where('active',1)
	    				->where('nameOrganization',$request->name_organization_auto)
	    				->first();
	    	
		    $brigade = new Brigade;

		    $brigade->nameBrigade = $request->nameBrigade;

		    $brigade->idorganization = $organization_brigade->idorganization;

		    $brigade->active = 1;

		    $brigade->save();

		    return redirect()->route('all-brigade');
		} 
  }
//Удаляем 
  public function deleteBrigade(Request $request){
      DB::update('update brigade set active = 0 where idBrigade = ?', [$request->id]);
      return redirect()->route('all-brigade');
  }
}
