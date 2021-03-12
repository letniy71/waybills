<?php

namespace App\Http\Controllers;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    //Получаем список организации
    public function getOrg()
    {
    	$org = Organization::where('active', 1)
		    	->get();

   		return view('org', ['org'=>$org]); 
    }
//Добавляем организации
    public function addOrg(Request $request)
  	{
	    if(!empty($_POST['nameOrganization'])) 
	    {
	    	
		    $org = new Organization;

		    $org->nameOrganization = $request->nameOrganization;

		    $org->active = 1;

		    $org->save();

		    return redirect()->route('all-org');
		} 
  }
//Удаляем организации
  public function deleteOrg(Request $request){
      DB::update('update organization set active = 0 where idOrganization = ?', [$request->id]);
      return redirect()->route('all-org');
  }
}
