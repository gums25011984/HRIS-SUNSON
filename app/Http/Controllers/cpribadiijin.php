<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cpribadiijin extends Controller
{
	  public function index()
		{
			$data = DB::select("SELECT a.idijin,a.idperijinan,a.tgl,b.nama AS karyawan,a.tgl_keluar,a.jam_keluar,a.tgl_kembali,a.jam_kembali,a.ket,c.nama_perijinan
FROM tijin AS a LEFT JOIN tkaryawan AS b ON a.`idkaryawan` = b.idkaryawan left join tperijinan as c ON a.idperijinan = c.idperijinan");

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
		public function pribadi_persetujuan()
		{
			$data = DB::select("SELECT b.idijin, c.ket_karu,c.ket_kaur,c.ket_kabag,c.ket_kadep,b.idkaryawan,a.nama,c.`tgl_keluar`,c.`tgl_kembali`,d.`jabatan`,COUNT(b.idcuti) AS jmlcuti FROM
tlistcuti AS b LEFT JOIN tkaryawan AS a ON a.`idkaryawan` = b.`idkaryawan`
LEFT JOIN tijin AS c ON b.`idijin` = c.`idijin`
LEFT JOIN tjabatan AS d ON a.`idjabatan` = d.`idjabatan`
  WHERE  (flag IS NULL OR (flag <> '1' AND flag <> '2')) GROUP BY c.tgl,a.idkaryawan,b.idijin,c.ket_karu,c.ket_kaur,c.ket_kabag,c.ket_kadep,b.idkaryawan,a.nama,c.`tgl_keluar`,c.`tgl_kembali`,d.`jabatan");
  
/*			 $data =  DB::table('tlistcuti as b')
						->selectRaw('b.idijin, c.ket_karu,c.ket_kaur,c.ket_kabag,c.ket_kadep,b.idkaryawan,a.nama,c.`tgl_keluar`,c.`tgl_kembali`,d.`jabatan`,COUNT(b.idcuti) AS jmlcuti')
						->join('tkaryawan as a', 'a.idkaryawan', '=', 'b.idkaryawan')
						->join('tijin as c', 'b.idijin', '=', 'c.idijin')
						->join('tjabatan as d', 'a.idjabatan', '=', 'd.idjabatan')
						->groupBy('c.tgl','a.idkaryawan')
						->get();*/
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
