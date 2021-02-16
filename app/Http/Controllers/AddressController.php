<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Brigade;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    //Получаем список 
    public function getAddress()
    {
    	$address = Address::where('active', 1)
		    	->get();
		$brigade = Brigade::where('active', 1)
		    	->get();    	


   		return view('address', ['address'=>$address, 'brigade'=>$brigade]); 
    }
//Добавляем 
    public function addAddress(Request $request)
  	{
	    if(!empty($_POST['address'])) 
	    {
	    	$brigade_address = Brigade::where('active',1)
	    				->where('nameBrigade',$request->name_brigade_address)
	    				->first();
	  
		    $address = new Address;

		    $address->address = $request->address;
		    $address->idBrigade = $brigade_address->idBrigade;
		    //$address->idOrganization = $org_address->idOrganization;

		    $address->active = 1;

		    $address->save();
		    return redirect()->route('all-address');
		} else {
			echo "заполните данные";
		}
  }
//Удаляем 
  public function deleteAddress(Request $request){

  	DB::update('update address set active = 0 where idAddress = ?', [$request->idAddress]);
  	return redirect()->route('all-address');
  }
}
