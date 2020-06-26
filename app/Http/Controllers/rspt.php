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
			
		$idmgroup_kerja = $request->idmgroup_kerja;
			$tahun = $request->tahun;
			$bulan = $request->bulan;
		$page = \Request::get('page') ?: 1;

			$perPage = \Request::get('perpage') ?: 10; 
			$sort = \Request::get('sort') ?: 'idjadwal_kerja';
		$tableIds = DB::select("SELECT a.idjadwal_kerja,YEAR(tgl) AS tahun,a.tgl AS startDate,a.tglend AS endDate,
b.kdparameter,c.kdmgroup_kerja,
YEAR(tgl) AS tahun1,
month(tgl) AS bulan1,
day(tgl) AS tgl1,
YEAR(tglend) AS tahun2,
month(tglend) AS bulan2,
day(tglend) AS tgl2
 FROM tjadwal_kerja AS a LEFT JOIN tparameter AS b ON a.idparameter = b.idparameter LEFT JOIN tmgroup_kerja AS c ON a.idmgroup_kerja = c.idmgroup_kerja WHERE 
a.idmgroup_kerja='$idmgroup_kerja' and YEAR(tglend)>='$tahun' AND MONTH(tglend)>='$bulan'  ");

        $jsonResult = array();
		
		
		
        for($i = 0;$i < count($tableIds);$i++)
        {
            $jsonResult[$i]["idjadwal_kerja"] = $tableIds[$i]->idjadwal_kerja;
			$jsonResult[$i]["tahun"] = $tableIds[$i]->tahun;
			$jsonResult[$i]["startDate"] = $tableIds[$i]->startDate;
			$jsonResult[$i]["endDate"] = $tableIds[$i]->endDate;
			$jsonResult[$i]["kdparameter"] = $tableIds[$i]->kdparameter;
			$jsonResult[$i]["kdmgroup_kerja"] = $tableIds[$i]->kdmgroup_kerja;

			$jsonResult[$i]["Tanggal_Awal"]["Tanggal"] =$tableIds[$i]->tgl1;
			$jsonResult[$i]["Tanggal_Awal"]["Bulan"] = $tableIds[$i]->bulan1;
			$jsonResult[$i]["Tanggal_Awal"]["Tahun"] = $tableIds[$i]->tahun1;
			$jsonResult[$i]["Tanggal_Akhir"]["Tanggal"] = $tableIds[$i]->tgl2;
			$jsonResult[$i]["Tanggal_Akhir"]["Bulan"] =$tableIds[$i]->bulan2;
			$jsonResult[$i]["Tanggal_Akhir"]["Tahun"] = $tableIds[$i]->tahun2;

			/*
			$jsonResult[$i] = DB::select( DB::raw("SELECT a.iddivisi,a.divisi FROM tkaryawan AS b LEFT JOIN tdivisi AS a ON a.iddivisi = b.`iddivisi` WHERE b.idkaryawan = $idkaryawan"));
			
			$jsonResult[$i]["location"]= DB::select( DB::raw("SELECT a.iddivisi,a.divisi,'' as approval FROM tkaryawan AS b LEFT JOIN tdivisi AS a ON a.iddivisi = b.`iddivisi` WHERE b.idkaryawan = $idkaryawan"));*/
	
			
			


			
        }

		$data=$this->paginate($jsonResult,$perPage);
		$data->appends($request->all());
		return($data);
		}
		
		 public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator(array_values($items->forPage($page, $perPage)->toArray()), $items->count(), $perPage, $page, array('path' => Paginator::resolveCurrentPath()));
        //ref for array_values() fix: https://stackoverflow.com/a/38712699/3553367
    }
}
