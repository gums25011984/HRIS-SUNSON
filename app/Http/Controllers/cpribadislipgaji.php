<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class cpribadislipgaji extends Controller
{
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idslipgaji';
			$data = DB::select("SELECT idslipgaji,bln,thn,periode,periodetglgaji,nik,nama,jabatan,departemen, divisi,hk,hl,mhk,mhl, qtyot,ot1,ot2,qtyotasli,status_kerja,gapok,tunj_jabatan,tunj_prestasi,premi_hadir,
tunj_rajin,lembur, tunj_masakerja, premi_shift,transport_lembur,tunj_lainnya,totgaji, pot_absen,pot_astek, pot_spsi,pot_bisnis, pot_koperasi,
tot_potongan, gaji_bersih FROM tslipgaji");

			$data=$this->paginate($data,$perPage);
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
		public function pribadi_slipgaji(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$data = DB::select("SELECT a.nik,a.`nama`,c.`mgroup_kerja`, b.`departemen`,d.pendidikan,a.`tanggal_masuk`,'' AS lama_kerja, 
b.`periodetglgaji`,b.`s1`,b.`s2`,b.`c1`,b.`c1a`,b.`c1b`,b.`c2`,b.`c1a`,b.`c1b`,b.`c2a`,b.`c`,b.`m`,b.`p`,b.`p1`,
b.`p2`,b.l,b.mhk, b.`gapok`,b.`tunj_jabatan`,b.`tunj_prestasi`,b.`premi_hadir`,b.`qtyotasli`,b.`premi_shift`,
b.`tunj_masakerja`, b.`totgaji`,b.`pot_absen`,b.`pot_astek`,b.`pot_spsi`,b.`pot_koperasi`,b.`pot_bisnis`,b.`gaji_bersih` 
FROM tkaryawan AS a LEFT JOIN tslipgaji AS b ON a.`idkaryawan` = b.`idkaryawan` LEFT JOIN 
tmgroup_kerja AS c ON a.`idgroup` = c.`idmgroup_kerja` LEFT JOIN tpendidikan AS d ON a.`idpendidikan` = d.`idpendidikan` ");

			if($data){ //mengecek apakah data kosong atau tidak
				
				$data = $this->paginate($data,$perPage);
				$data->appends($request->all());
				return response($data);
			}
		}
		
		
		
}
