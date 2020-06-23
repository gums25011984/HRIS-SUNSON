<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class rjabatan extends Controller
{

	  public function index(Request $request)
		{
			
		
		$srch = $request->srch; 
	/*	$tableIds = DB::select( DB::raw("SELECT idjabatan,jabatan,'' as karyawan FROM tjabatan"));*/
		$tableIds = DB::select( DB::raw("SELECT * FROM tjabatan where kdjabatan like '$srch%' or jabatan like '$srch%'"));
        $jsonResult = array();
		
		
		
        for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idjabatan"] = $tableIds[$i]->idjabatan;
			$jsonResult[$i]["kdjabatan"] = $tableIds[$i]->kdjabatan;
			$jsonResult[$i]["jabatan"] = $tableIds[$i]->jabatan;
			$jsonResult[$i]["insert_by"] = $tableIds[$i]->insert_by;
			$jsonResult[$i]["insert_time"] = $tableIds[$i]->insert_time;
			$jsonResult[$i]["update_by"] = $tableIds[$i]->update_by;
			$jsonResult[$i]["update_time"] = $tableIds[$i]->update_time;
            /*$jsonResult[$i]["idjabatan"] = $tableIds[$i]->idjabatan;
			$jsonResult[$i]["jabatan"] = $tableIds[$i]->jabatan;*/
            /*$id = $tableIds[$i]->idjabatan;*/
            /*$jsonResult[$i]["karyawan"] = DB::select( DB::raw("SELECT nik,nama,idjabatan  FROM tkaryawan WHERE idjabatan = $id limit 1"));*/
        }

		
	    $data = $this->paginate($jsonResult);
		
        return $data;
		}
		/*public function paginate($items, $perPage = 2, $page = null, $options = [])
    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
		
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }*/
		
		
		public function paginate($items,$perPage=2,$pageStart=1)
		{
			
			// Start displaying items from this number;
			$offSet = ($pageStart * $perPage) - $perPage; 
	
			// Get only the items you need using array_slice
			$itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);
	
			return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
		}
}
