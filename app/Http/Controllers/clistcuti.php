<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class clistcuti extends Controller
{
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 100;
			$search = $request->search;
			$perpage = \Request::get('perpage') ?: 10; 
			
			$tableIds = DB::select("SELECT a.idkaryawan,a.nik,a.nama,IFNULL(e.penggunaan_cuti,0) AS cuti_digunakan,IFNULL(c.cuti_darilembur,0) AS cuti_darilembur,
		IFNULL(t1.cutitahunan,0) AS cutitahunan,IFNULL(b.cutikip,0) AS cutikip,IFNULL(d.cutiip,0) AS cutiip,
		IFNULL(c.cuti_darilembur,0) + IFNULL(t1.cutitahunan,0) + IFNULL(b.cutikip,0) + IFNULL(d.cutiip,0) AS jmlcuti,
		(IFNULL(c.cuti_darilembur,0) + IFNULL(t1.cutitahunan,0) + IFNULL(b.cutikip,0) + IFNULL(d.cutiip,0))-IFNULL(e.penggunaan_cuti,0)  AS sisa_cuti
		FROM tkaryawan AS a LEFT JOIN (
			  SELECT  a.nik,SUM(jmlcuti) AS cutitahunan FROM  tcutitahunan AS a GROUP BY a.nik
			 ) t1  ON a.`nik` = t1.nik LEFT JOIN
			 (
			  SELECT  c.nik,SUM(jmlcuti) AS cutikip FROM  tkip AS c GROUP BY c.nik
			 ) AS b ON a.nik  = b.nik LEFT JOIN 
			 (
			  SELECT  c.nik,COUNT(c.nik) AS cuti_darilembur FROM  tcuti_uang AS c GROUP BY c.nik
			 ) AS c ON a.nik  = c.nik LEFT JOIN
			 (
			  SELECT  d.nik,SUM(jmlcuti) AS cutiip FROM  tip AS d GROUP BY d.nik
			 ) AS d ON a.nik  = d.nik LEFT JOIN 
			 (
			  SELECT  c.idkaryawan,COUNT(idkaryawan) AS penggunaan_cuti FROM  tlistcuti AS c 
			WHERE c.idcuti NOT IN ( 12,13,14,15,16,17,18,20,23,24)  
			  GROUP BY c.idkaryawan
			 ) AS e ON a.idkaryawan  = e.idkaryawan where a.nik like '$search%'");

			$jsonResult = array();
		
		for($i = 0;$i < count($tableIds);$i++)
        {
			
			$jsonResult[$i]["idkaryawan"] = $tableIds[$i]->idkaryawan;
			$jsonResult[$i]["nik"] = $tableIds[$i]->nik;
			$jsonResult[$i]["nama"] = $tableIds[$i]->nama;
			$jsonResult[$i]["cuti_digunakan"] = $tableIds[$i]->cuti_digunakan;
			$jsonResult[$i]["cuti_darilembur"] = $tableIds[$i]->cuti_darilembur;
			$jsonResult[$i]["cutitahunan"] = $tableIds[$i]->cutitahunan;
			$jsonResult[$i]["cutikip"] = $tableIds[$i]->cutikip;
			$jsonResult[$i]["cutiip"] = $tableIds[$i]->cutiip;
			$jsonResult[$i]["sisa_cuti"] = $tableIds[$i]->sisa_cuti;


			
			
		 }
		 $data = $this->paginate($jsonResult,$page,$perpage);
		$data->appends($request->all());
        return $data;
		}
		
		
		
	public function paginate($items,$page,$perPage,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($page* $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
		
}
