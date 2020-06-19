<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class cslipgaji extends Controller
{
	 public function index(Request $request)
		{
			$search = $request->search; 
			$per_page = $request->per_page;
			$pageStart = $request->page;
			
			$tableIds = DB::select("SELECT idslipgaji,bln,thn,periode,periodetglgaji,nik,nama,jabatan,departemen, divisi,kalender,hk,hl,mhk,mhl, qtyot,ot1,ot2,qtyotasli,status_kerja,gapok,tunj_jabatan,tunj_prestasi,premi_hadir,
tunj_rajin,lembur, tunj_masakerja, premi_shift,transport_lembur,tunj_lainnya,totgaji, pot_absen,pot_astek, pot_spsi,pot_bisnis, pot_koperasi,
tot_potongan, gaji_bersih FROM tslipgaji where  (nama like '" . $search . "%' or nik like '" . $search . "%' or jabatan like '" . $search . "%' or departemen like '" . $search . "%') ");

		$jsonResult = array();
		
		for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idslipgaji"] = $tableIds[$i]->idslipgaji;
			$jsonResult[$i]["bln"] = $tableIds[$i]->bln;
			$jsonResult[$i]["thn"] = $tableIds[$i]->thn;
			$jsonResult[$i]["periode"] = $tableIds[$i]->periode;
			$jsonResult[$i]["periodetglgaji"] = $tableIds[$i]->periodetglgaji;
			$jsonResult[$i]["nik"] = $tableIds[$i]->nik;
			$jsonResult[$i]["nama"] = $tableIds[$i]->nama;
			
			$jsonResult[$i]["jabatan"] = $tableIds[$i]->jabatan;
			$jsonResult[$i]["departemen"] = $tableIds[$i]->departemen;
			$jsonResult[$i]["divisi"] = $tableIds[$i]->divisi;
			$jsonResult[$i]["kalender"] = $tableIds[$i]->kalender;
			$jsonResult[$i]["hk"] = $tableIds[$i]->hk;
			$jsonResult[$i]["hl"] = $tableIds[$i]->hl;
			$jsonResult[$i]["mhk"] = $tableIds[$i]->mhk;
			
			$jsonResult[$i]["mhl"] = $tableIds[$i]->mhl;
			$jsonResult[$i]["qtyot"] = $tableIds[$i]->qtyot;
			$jsonResult[$i]["ot1"] = $tableIds[$i]->ot1;
			$jsonResult[$i]["ot2"] = $tableIds[$i]->ot2;
			$jsonResult[$i]["qtyotasli"] = $tableIds[$i]->qtyotasli;
			$jsonResult[$i]["status_kerja"] = $tableIds[$i]->status_kerja;
			$jsonResult[$i]["gapok"] = $tableIds[$i]->gapok;
			
			$jsonResult[$i]["tunj_jabatan"] = $tableIds[$i]->tunj_jabatan;
			$jsonResult[$i]["tunj_prestasi"] = $tableIds[$i]->tunj_prestasi;
			$jsonResult[$i]["premi_hadir"] = $tableIds[$i]->premi_hadir;
			$jsonResult[$i]["tunj_rajin"] = $tableIds[$i]->tunj_rajin;
			$jsonResult[$i]["lembur"] = $tableIds[$i]->lembur;
			$jsonResult[$i]["tunj_masakerja"] = $tableIds[$i]->tunj_masakerja;
			$jsonResult[$i]["premi_shift"] = $tableIds[$i]->premi_shift;
			
				
			$jsonResult[$i]["transport_lembur"] = $tableIds[$i]->transport_lembur;
			$jsonResult[$i]["tunj_lainnya"] = $tableIds[$i]->tunj_lainnya;
			$jsonResult[$i]["totgaji"] = $tableIds[$i]->totgaji;
			$jsonResult[$i]["pot_absen"] = $tableIds[$i]->pot_absen;
			$jsonResult[$i]["pot_astek"] = $tableIds[$i]->pot_astek;
			$jsonResult[$i]["pot_spsi"] = $tableIds[$i]->pot_spsi;
			$jsonResult[$i]["pot_bisnis"] = $tableIds[$i]->pot_bisnis;
			$jsonResult[$i]["pot_koperasi"] = $tableIds[$i]->pot_koperasi;
			$jsonResult[$i]["tot_potongan"] = $tableIds[$i]->tot_potongan;
			$jsonResult[$i]["gaji_bersih"] = $tableIds[$i]->gaji_bersih;
			
		 }
		 if($jsonResult > 0){ //mengecek apakah data kosong atau tidak
				
				$res = $this->paginate($jsonResult,$per_page,$pageStart);
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		
		}
		
		public function paginate($items,$per_page,$pageStart)
		{
			$per_page = \Request::get('per_page') ?: 100;
			// Start displaying items from this number;
			$offSet = ($pageStart * $per_page) - $per_page; 
	
			// Get only the items you need using array_slice
			$itemsForCurrentPage = array_slice($items, $offSet, $per_page, true);
	
			return new LengthAwarePaginator($itemsForCurrentPage, count($items), $per_page,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
		}
		
}
