<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class cabsen extends Controller
{
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$search = $request->search;
			$perpage = \Request::get('perpage') ?: 10; 
		    $sort = \Request::get('sort') ?: 'idabsen';
			
			$tableIds = DB::select("SELECT a.idabsen,a.tgl_load,a.nik,b.nama,a.tgl_masuk,a.tgl_pulang,a.jam_masuk,a.jam_pulang, a.qtyotasli,a.premi_shift,a.jam_pulang,c.nospl,a.otstart,a.otend,a.ot1,a.ot2,a.qtyot,a.jam_wajib_masuk,a.jam_wajib_keluar,d.parameter,a.qty_jam,a.transport_lembur FROM tabsen AS a LEFT JOIN tkaryawan AS b ON a.nik = b.nik LEFT JOIN tspl AS c ON a.idspl = c.idspl LEFT JOIN tparameter AS d ON a.idparameter = d.idparameter  where b.nama like '" . $search . "%' or a.nik like '" . $search . "%' ");

		$jsonResult = array();
        for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idabsen"] = $tableIds[$i]->idabsen;
			$jsonResult[$i]["tgl_load"] = $tableIds[$i]->tgl_load;
			$jsonResult[$i]["nik"] = $tableIds[$i]->nik;
			$jsonResult[$i]["nama"] = $tableIds[$i]->nama;
			$jsonResult[$i]["tgl_pulang"] = $tableIds[$i]->tgl_pulang;
			$jsonResult[$i]["jam_masuk"] = $tableIds[$i]->jam_masuk;
			$jsonResult[$i]["jam_pulang"] = $tableIds[$i]->jam_pulang;
			$jsonResult[$i]["qtyotasli"] = $tableIds[$i]->qtyotasli;
			$jsonResult[$i]["premi_shift"] = $tableIds[$i]->premi_shift;
			$jsonResult[$i]["nospl"] = $tableIds[$i]->nospl;
			$jsonResult[$i]["otstart"] = $tableIds[$i]->otstart;
			$jsonResult[$i]["otend"] = $tableIds[$i]->otend;
			$jsonResult[$i]["ot1"] = $tableIds[$i]->ot1;
			$jsonResult[$i]["ot2"] = $tableIds[$i]->ot2;
			$jsonResult[$i]["qtyot"] = $tableIds[$i]->qtyot;
			$jsonResult[$i]["jam_wajib_masuk"] = $tableIds[$i]->jam_wajib_masuk;
			$jsonResult[$i]["jam_wajib_keluar"] = $tableIds[$i]->jam_wajib_keluar;
			$jsonResult[$i]["parameter"] = $tableIds[$i]->parameter;
			$jsonResult[$i]["qty_jam"] = $tableIds[$i]->qty_jam;
			$jsonResult[$i]["transport_lembur"] = $tableIds[$i]->transport_lembur;
		 }
		 
		 $data = $this->paginate($jsonResult,$page,$perpage);
		
        return $data;
		}
		
		
		
	public function paginate($items,$page,$perPage,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
		
}
