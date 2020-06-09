<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cpribadispkl extends Controller
{
	  public function index()
		{
			$data = DB::select("SELECT a.idspl,a.`nospl`,a.tgl,e.nama AS leader,a.jam,a.`jam_mulai`,a.`jam_berakhir`,c.nama AS manager, 								  a.acc,a. ket
FROM tspl AS a LEFT JOIN tkaryawan AS b ON a.`permintaan_dari` = b.idkaryawan LEFT JOIN tkaryawan AS c ON a.`idmanager` = 					
c.idkaryawan left join tspldtl as d ON a.nospl = d.nospl 
left join tkaryawan as e ON d.idkaryawan = e.idkaryawan");

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
		public function pribadi_spkl()
		{
			$data = DB::select("SELECT a.idspl,a.`nospl`,a.tgl,b.nama AS leader,a.jam,a.`jam_mulai`,a.`jam_berakhir`,a. ket,a.ket_kabag,a.ket_kadep,a.ket_manager
FROM tspl AS a LEFT JOIN tkaryawan AS b ON a.`permintaan_dari` = b.idkaryawan LEFT JOIN tkaryawan AS c ON a.`idmanager` = 					
c.idkaryawan left join tspldtl as d ON a.nospl = d.nospl where (a.acc IS NULL OR (a.acc <> '1' and a.acc <> '2'))");

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
