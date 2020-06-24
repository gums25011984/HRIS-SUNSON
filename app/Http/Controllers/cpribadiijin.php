<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class cpribadiijin extends Controller
{
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$search = $request->search;
			$perPage = \Request::get('perpage') ?: 10; 
			
			$data = DB::select("SELECT a.idijin,a.idperijinan,a.tgl,b.nama AS karyawan,a.tgl_keluar,a.jam_keluar,a.tgl_kembali,a.jam_kembali,a.ket,c.nama_perijinan
FROM tijin AS a LEFT JOIN tkaryawan AS b ON a.`idkaryawan` = b.idkaryawan left join tperijinan as c ON a.idperijinan = c.idperijinan");

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
		
		
		
		public function pribadi_persetujuan(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$search = $request->search;
			$perPage = \Request::get('perpage') ?: 10;
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
			if($data){ //mengecek apakah data kosong atau tidak
				
				$data = $this->paginate($data,$perPage);
				$data->appends($request->all());
				return response($data);
			}
		}
		
		
		
}
