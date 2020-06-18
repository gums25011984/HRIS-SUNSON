<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class rspt extends Controller
{

	  public function index(Request $request)
		{
			
		
		$srch = $request->srch; 
		$tableIds = DB::select( DB::raw("SELECT a.idijin,a.idkaryawan,b.nama_perijinan FROM tijin AS a LEFT JOIN tperijinan AS b ON a.`idperijinan` = b.`idperijinan`"));

        $jsonResult = array();
		
		
		
        for($i = 0;$i < count($tableIds);$i++)
        {
            $jsonResult[$i]["idApproval"] = $tableIds[$i]->idijin;
			$jsonResult[$i]["nameApproval"] = $tableIds[$i]->nama_perijinan;
            $idijin = $tableIds[$i]->idijin;
			$idkaryawan = $tableIds[$i]->idkaryawan;
			
			/*$tableIds1 = DB::select( DB::raw("SELECT a.iddivisi,a.divisi FROM tkaryawan AS b LEFT JOIN tdivisi AS a ON a.iddivisi = b.`iddivisi` WHERE b.idkaryawan = $idkaryawan"));*/
			
			$jsonResult[$i]["location"]= DB::select( DB::raw("SELECT a.iddivisi,a.divisi,'' as approval FROM tkaryawan AS b LEFT JOIN tdivisi AS a ON a.iddivisi = b.`iddivisi` WHERE b.idkaryawan = $idkaryawan"));
	
			
			$jsonResult[$i]["location"]["approval"]= DB::select( DB::raw("SELECT a.idjabatan,a.jabatan FROM tkaryawan AS b LEFT JOIN tjabatan AS a ON a.idjabatan = b.`idjabatan` WHERE b.idkaryawan = $idkaryawan"));


			
        }

		
	    $data = $this->paginate($jsonResult);
		
        return $data;
		}
		
		
		
		public function paginate($items,$perPage=2,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
}
