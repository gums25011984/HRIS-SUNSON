<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class cpribadimutasi extends Controller
{
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$search = $request->search;
			$perpage = \Request::get('perpage') ?: 10; 
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

			if($data){ //mengecek apakah data kosong atau tidak
				
				$data = $this->paginate($data,$page,$perpage);
				return response($data);
			}
		}
		
		public function pribadi_mutasi(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$search = $request->search;
			$perpage = \Request::get('perpage') ?: 10; 
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

			if($data){ //mengecek apakah data kosong atau tidak
				
				$data = $this->paginate($data,$page,$perpage);
				$data->appends($request->all());
				return response($data);
			}
		}
		
		public function paginate($items,$page,$perPage,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
		
		
		
}
