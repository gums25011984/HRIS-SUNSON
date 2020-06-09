<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cslipgaji extends Controller
{
	  public function index()
		{
			$data = DB::select("SELECT idslipgaji,bln,thn,periode,periodetglgaji,nik,nama,jabatan,departemen, divisi,kalender,hk,hl,mhk,mhl, qtyot,ot1,ot2,qtyotasli,status_kerja,gapok,tunj_jabatan,tunj_prestasi,premi_hadir,
tunj_rajin,lembur, tunj_masakerja, premi_shift,transport_lembur,tunj_lainnya,totgaji, pot_absen,pot_astek, pot_spsi,pot_bisnis, pot_koperasi,
tot_potongan, gaji_bersih FROM tslipgaji");

			if($data > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $data;
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
}
