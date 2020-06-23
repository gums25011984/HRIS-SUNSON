<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class cpribadispkl extends Controller
{
	public function paginate($items,$page,$perPage,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($page* $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
	
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 100;
			$perpage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$data = DB::select("SELECT a.idspl,a.`nospl`,a.tgl,e.nama AS leader,a.jam,a.`jam_mulai`,a.`jam_berakhir`,c.nama AS manager, 								  a.acc,a. ket
FROM tspl AS a LEFT JOIN tkaryawan AS b ON a.`permintaan_dari` = b.idkaryawan LEFT JOIN tkaryawan AS c ON a.`idmanager` = 					
c.idkaryawan left join tspldtl as d ON a.nospl = d.nospl 
left join tkaryawan as e ON d.idkaryawan = e.idkaryawan");

			if($data){ //mengecek apakah data kosong atau tidak
				
				$data = $this->paginate($data,$page,$perpage);
				$data->appends($request->all());
				return response($data);
			}
		}
		public function pribadi_spkl(Request $request)
		{
			$page = \Request::get('page') ?: 100;
			$perpage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$data = DB::select("SELECT a.idspl,a.`nospl`,a.tgl,b.nama AS leader,a.jam,a.`jam_mulai`,a.`jam_berakhir`,a. ket,a.ket_kabag,a.ket_kadep,a.ket_manager
FROM tspl AS a LEFT JOIN tkaryawan AS b ON a.`permintaan_dari` = b.idkaryawan LEFT JOIN tkaryawan AS c ON a.`idmanager` = 					
c.idkaryawan left join tspldtl as d ON a.nospl = d.nospl where (a.acc IS NULL OR (a.acc <> '1' and a.acc <> '2'))");

			if($data){ //mengecek apakah data kosong atau tidak
				
				$data = $this->paginate($data,$page,$perpage);
				$data->appends($request->all());
				return response($data);
			}
		}
		
		
		
}
