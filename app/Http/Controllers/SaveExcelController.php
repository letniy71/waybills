<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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

class SaveExcelController extends Controller
{
	private function getRow($nameModel, $nameId, $id)
	{
		$nameModel = $nameModel::where("$nameId",$id)
								->first();
		return $nameModel;
	}

	private function timeWB($nameBrigade,$idtypeWB)
	{
		if($nameBrigade == '10'){
		  if($typeWB->idtypeWB == 1) {
		    $time1 = "7.00";
		    $time2 = "20.00"; 
		  } else {
		    $time1 = "20.00";
		    $time2 = '7.00';
		  }
		} else {
		  if($idtypeWB == 1) {
		    $time1 = "6.10";
		    $time2 = "18.00"; 
		  } else {
		    $time1 = "18.10";
		    $time2 = '6.00';
		  }
		}
		
		return ['time1'=>$time1,'time2'=>$time2];
	}



    public function saveXlsx(Request $request)
    {	
    	//получаем даные из БД по waybills
    	$waybill = $this->getRow('App\Models\Waybills', 'idWaybills', $request->idWaybills);

    	//получаем даные из БД по Водителю
    	$driver = $this->getRow('App\Models\Drivers', 'idDrivers', $waybill->idDrivers);

    	//получаем даные из БД по Авто
    	$auto = $this->getRow('App\Models\Auto', 'idAuto', $waybill->idAuto);

    	//получаем даные из БД по Dispatchers
    	$dispatchers = $this->getRow('App\Models\Dispatchers', 'idDispatcher', $waybill->idDispatcher);

    	//получаем даные из БД по Mechanics
    	$mechanics = $this->getRow('App\Models\Mechanics', 'idMechanics', $waybill->idMechanics);

    	//получаем даные из БД по Route
    	$route = $this->getRow('App\Models\Route', 'idRoute', $waybill->idroute);

    	//получаем даные из БД по Address
    	$address = $this->getRow('App\Models\Address', 'idAddress', $waybill->idAddress);

    	$brigade = $this->getRow('App\Models\Brigade', 'idBrigade', $waybill->idBrigade);

    	$typeWB = $this->getRow('App\Models\TypeWB', 'idtypeWB', $waybill->idtypeWB);

    	//разбиваем дату на отдельные элементы(вставлять год месяц и день нужно в разные ячейки)
		$str_day = substr($waybill->date, 0, 2);
		$str_month = substr($waybill->date, 3, 2);
		$str_year = substr($waybill->date, 6, 4);


		$time = $this->timeWB($brigade->nameBrigade, $typeWB->idtypeWB);
		$time1 = $time['time1'];
		$time2 = $time['time2'];

		if($brigade->nameBrigade == 10) {
		  $hours = 12;
		} else {
		  $hours = 10;
		}

    	//Подставляем данные в файл

    	$inputFileName = 'Excel/example.xlsx';
        $spreadsheet = new Spreadsheet();

		/** Load $inputFileName to a Spreadsheet object **/
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('T3', $waybill->serialWay)
				->setCellValue('BA3', $waybill->serialWay)
				->setCellValue('BS3',$waybill->serialWay)
				->setCellValue('Y3', $waybill->numberWay)
				->setCellValue('BF3', $waybill->numberWay)
				->setCellValue('BX3', $waybill->numberWay)
				->setCellValue('k4', $str_day)
				->setCellValue('M4', $str_month)
				->setCellValue('Q4', $str_year)
				->setCellValue('BO5', $str_day)
				->setCellValue('AY5', $str_month)
				->setCellValue('BC5', $str_year)
				->setCellValue('AW5', $str_day)
				->setCellValue('BQ5', $str_month)
				->setCellValue('BU5', $str_year)
				->setCellValue('E13', $driver->name)
				->setCellValue('AJ49', $driver->name)
				->setCellValue('AJ53', $driver->name)
				->setCellValue('H15', $driver->sertificate)
				->setCellValue('L12', $auto->number)
				->setCellValue('BC13', $auto->number)
				->setCellValue('L12', $auto->number)
				->setCellValue('I11', $auto->model)
				->setCellValue('BU15', $auto->number)
				->setCellValue('AW11',$auto->model)
				->setCellValue('BO12', $auto->model)
				->setCellValue('L52', $dispatchers->nameDispatcher)
				->setCellValue('AJ47', $mechanics->nameMechanic)
				->setCellValue('AJ55', $mechanics->nameMechanic)
				->setCellValue('CF9', $route->route)
				->setCellValue('CF11', $address->address)
				->setCellValue('G28', $time1)
				->setCellValue('G30', $time2)
				->setCellValue('AY28', $time1)
				->setCellValue('AY30', $time2)
				->setCellValue('BQ30', $time1)
				->setCellValue('BQ32', $time2)
				->setCellValue('AX48', $hours)
				->setCellValue('CF13', "Отработано ". $hours . " часов, обед 1 час")
				->setCellValue('BP50', $hours);

        $writer = new Xlsx($spreadsheet);
        $writer->save('Excel/путевой_лист.xlsx');

        return response()->download('Excel/путевой_лист.xlsx');
    }

    public function saveAllXlsx(Request $request)
    {
    	//получаем даные из БД по waybills
    	if($request->nameBrigade == 0)
    	{
    		$waybills = Waybills::where('active', 1)
	    			->where('date', $request->date)
			    	->get();
    	}else {
    		$waybills = Waybills::where('idBrigade', $request->idBrigade)
	    			->where('active', 1)
	    			->where('date', $request->date)
			    	->get();
    	}
		
		$waybillsId  = $waybills->pluck('idWaybills');


		


		$inputFileName = 'Excel/example.xlsx';

        $spreadsheet = new Spreadsheet();

		/** Load $inputFileName to a Spreadsheet object **/
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);


		foreach ($waybillsId as $key => $idwaybills) {

		
			$waybill = $this->getRow('App\Models\Waybills', 'idWaybills', $idwaybills);
	    	//получаем даные из БД по Водителю
	    	$driver = $this->getRow('App\Models\Drivers', 'idDrivers', $waybill->idDrivers);

	    	//получаем даные из БД по Авто
	    	$auto = $this->getRow('App\Models\Auto', 'idAuto', $waybill->idAuto);

	    	//получаем даные из БД по Dispatchers
	    	$dispatchers = $this->getRow('App\Models\Dispatchers', 'idDispatcher', $waybill->idDispatcher);

	    	//получаем даные из БД по Mechanics
	    	$mechanics = $this->getRow('App\Models\Mechanics', 'idMechanics', $waybill->idMechanics);

	    	//получаем даные из БД по Route
	    	$route = $this->getRow('App\Models\Route', 'idRoute', $waybill->idroute);

	    	//получаем даные из БД по Address
	    	$address = $this->getRow('App\Models\Address', 'idAddress', $waybill->idAddress);

	    	$brigade = $this->getRow('App\Models\Brigade', 'idBrigade', $waybill->idBrigade);

	    	$typeWB = $this->getRow('App\Models\TypeWB', 'idtypeWB', $waybill->idtypeWB);

	    	//разбиваем дату на отдельные элементы(вставлять год месяц и день нужно в разные ячейки)
			$str_day = substr($waybill->date, 0, 2);
			$str_month = substr($waybill->date, 3, 2);
			$str_year = substr($waybill->date, 6, 4);


			$time = $this->timeWB($brigade->nameBrigade, $typeWB->idtypeWB);
			$time1 = $time['time1'];
			$time2 = $time['time2'];

			if($brigade->nameBrigade == 10) {
			  $hours = 12;
			} else {
			  $hours = 10;
			}

			$template = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
			$newSheet = clone $template->getActiveSheet()->setTitle("$key");
			$spreadsheet->addExternalSheet($newSheet)
				->setCellValue('T3', $waybill->serialWay)
				->setCellValue('BA3', $waybill->serialWay)
				->setCellValue('BS3',$waybill->serialWay)
				->setCellValue('Y3', $waybill->numberWay)
				->setCellValue('BF3', $waybill->numberWay)
				->setCellValue('BX3', $waybill->numberWay)
				->setCellValue('k4', $str_day)
				->setCellValue('M4', $str_month)
				->setCellValue('Q4', $str_year)
				->setCellValue('BO5', $str_day)
				->setCellValue('AY5', $str_month)
				->setCellValue('BC5', $str_year)
				->setCellValue('AW5', $str_day)
				->setCellValue('BQ5', $str_month)
				->setCellValue('BU5', $str_year)
				->setCellValue('E13', $driver->name)
				->setCellValue('AJ49', $driver->name)
				->setCellValue('AJ53', $driver->name)
				->setCellValue('H15', $driver->sertificate)
				->setCellValue('L12', $auto->number)
				->setCellValue('BC13', $auto->number)
				->setCellValue('L12', $auto->number)
				->setCellValue('I11', $auto->model)
				->setCellValue('BU15', $auto->number)
				->setCellValue('AW11',$auto->model)
				->setCellValue('BO12', $auto->model)
				->setCellValue('L52', $dispatchers->nameDispatcher)
				->setCellValue('AJ47', $mechanics->nameMechanic)
				->setCellValue('AJ55', $mechanics->nameMechanic)
				->setCellValue('CF9', $route->route)
				->setCellValue('CF11', $address->address)
				->setCellValue('G28', $time1)
				->setCellValue('G30', $time2)
				->setCellValue('AY28', $time1)
				->setCellValue('AY30', $time2)
				->setCellValue('BQ30', $time1)
				->setCellValue('BQ32', $time2)
				->setCellValue('AX48', $hours)
				->setCellValue('CF13', "Отработано ". $hours . " часов, обед 1 час")
				->setCellValue('BP50', $hours);
		}
		$spreadsheet->removeSheetByIndex(0);
		$writer = new Xlsx($spreadsheet);
        $writer->save('Excel/путевой_лист_все.xlsx');

        return response()->download('Excel/путевой_лист_все.xlsx');
        
	}
}