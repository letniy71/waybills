<?php

namespace App\Http\Controllers;
use App\Models\Auto;
use App\Models\Brigade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoController extends Controller
{
    //Получаем список авто
    public function getAuto()
    {
    	$auto = Auto::where('active', 1)
		    	->get();
		$brigade = Brigade::where('active', 1)
		    	->get();
		//dump($auto);

   		return view('auto', ['auto'=>$auto, 'brigade'=>$brigade]); 
    }
//Добавляем авто
    public function addAuto(Request $request)
  	{
	    if(!empty($_POST['model']&&$_POST['number']&&$_POST['name_brigade_auto'])) 
	    {
	    	$brigade_auto = Brigade::where('active',1)
	    				->where('nameBrigade',$request->name_brigade_auto)
	    				->first();

		    $auto = new Auto;

		    $auto->model = $request->model;
		    $auto->idBrigade = $brigade_auto->idBrigade;
		    $auto->number = $request->number;

		    $auto->active = 1;

		    $auto->save();
		    return redirect()->route('all-auto');
		} else {
			echo "заполните данные";
		}
  }
//Удаляем Авто
  public function deleteAuto(Request $request){

  	DB::update('update auto set active = 0 where idAuto = ?', [$request->idAuto]);

/* Так не работает .....
  	$auto = Auto::find($request->idAuto);
 	$auto->active =0;
 	$auto->save();
 	*/
  	return redirect()->route('all-auto');
  }
}
