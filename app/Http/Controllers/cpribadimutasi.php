<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cpribadimutasi extends Controller
{
	  public function index()
		{
			$data = DB::select("SELECT a.idkaryawan,a.idmutasi,a.tgl,b.nik,b.nama ,c.departemen AS dept_awal,d.divisi AS 
div_awal,e.jabatan AS jab_awal,f.departemen AS dept,g.divisi AS divisi,h.jabatan AS jabatan, a.ket,
a.nmkadep,a.`tglacckadep`,a.`nmhrd`,a.`tglacchrd`,a.`nmdirektur`,a.`tglaccdirektur`,
a.`iddepartemen_baru`,a.`iddivisi_baru`,a.`idjabatan_baru`,
a.`iddepartemen_asal`,a.`iddivisi_asal`,a.`idjabatan_asal`
FROM tmutasi AS a LEFT JOIN tkaryawan AS b ON a.idkaryawan = b.idkaryawan 
LEFT JOIN tdepartemen AS c ON a.iddepartemen_asal = c.iddepartemen 
LEFT JOIN tdivisi AS d ON a.iddivisi_asal = d.iddivisi 
LEFT JOIN tjabatan AS e ON a.idjabatan_asal = b.idjabatan
LEFT JOIN tdepartemen AS f ON a.`iddepartemen_baru` = f.`iddepartemen`
LEFT JOIN tdivisi AS g ON a.`iddivisi_baru` = g.`iddivisi`
LEFT JOIN tjabatan AS h ON a.`idjabatan_baru` = h.idjabatan");

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
		public function pribadi_mutasi()
		{
			$data = DB::select("SELECT a.idkaryawan,a.idmutasi,a.tgl,b.nik,b.nama ,c.departemen AS dept_awal,d.divisi AS 
div_awal,e.jabatan AS jab_awal,f.departemen AS dept,g.divisi AS divisi,h.jabatan AS jabatan, a.ket,
a.nmkadep,a.`tglacckadep`,a.`nmhrd`,a.`tglacchrd`,a.`nmdirektur`,a.`tglaccdirektur`,
a.`iddepartemen_baru`,a.`iddivisi_baru`,a.`idjabatan_baru`,
a.`iddepartemen_asal`,a.`iddivisi_asal`,a.`idjabatan_asal`,a.ketkadep,a.kethrd,a.ketdirektur
FROM tmutasi AS a LEFT JOIN tkaryawan AS b ON a.idkaryawan = b.idkaryawan 
LEFT JOIN tdepartemen AS c ON a.iddepartemen_asal = c.iddepartemen 
LEFT JOIN tdivisi AS d ON a.iddivisi_asal = d.iddivisi 
LEFT JOIN tjabatan AS e ON a.idjabatan_asal = b.idjabatan
LEFT JOIN tdepartemen AS f ON a.`iddepartemen_baru` = f.`iddepartemen`
LEFT JOIN tdivisi AS g ON a.`iddivisi_baru` = g.`iddivisi`
LEFT JOIN tjabatan AS h ON a.`idjabatan_baru` = h.idjabatan WHERE  (acc IS NULL OR (acc <> '1' AND acc <> '2'))");

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
