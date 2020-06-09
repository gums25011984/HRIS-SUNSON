<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cabsen extends Controller
{
	  public function index()
		{
			$data = DB::select("SELECT a.idabsen,a.tgl_load,a.nik,b.nama,a.tgl_masuk,a.tgl_pulang,a.jam_masuk,a.jam_pulang, a.qtyotasli,a.premi_shift,
a.jam_pulang,c.nospl,a.otstart,a.otend,a.ot1,a.ot2,a.qtyot,a.jam_wajib_masuk,a.jam_wajib_keluar,d.parameter,a.qty_jam,a.transport_lembur
        FROM tabsen AS a LEFT JOIN tkaryawan AS b ON a.nik = b.nik LEFT JOIN tspl AS c ON a.idspl = c.idspl
		LEFT JOIN tparameter AS d ON a.idparameter = d.idparameter");

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
