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
			$perPage = $request->perpage;
			$page = $request->page;
			
			$tableIds = DB::select("SELECT idslipgaji,bln,thn,periode,periodetglgaji,nik,nama,jabatan,departemen, divisi,kalender,hk,hl,mhk,mhl, qtyot,ot1,ot2,qtyotasli,status_kerja,gapok,tunj_jabatan,tunj_prestasi,premi_hadir,
tunj_rajin,lembur, tunj_masakerja, premi_shift,transport_lembur,tunj_lainnya,totgaji, pot_absen,pot_astek, pot_spsi,pot_bisnis, pot_koperasi,
tot_potongan, gaji_bersih FROM tslipgaji where  (nama like '" . $search . "%' or nik like '" . $search . "%' or jabatan like '" . $search . "%' or departemen like '" . $search . "%') ");

		$data=$this->paginate($tableIds,$perPage);
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
