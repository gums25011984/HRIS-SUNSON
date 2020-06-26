<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class crole_permission extends Controller
{
	
			
		public function index(Request $request)
		{
		$search = $request->search; 
		$page = $request->page; 
		$idjabatan = $request->idjabatan; 
		$iddivisi = $request->iddivisi; 
		$iddepartemen = $request->iddepartemen; 
		$sort = \Request::get('sort') ?: 'idpermission';
	/*	$tableIds = DB::select( DB::raw("SELECT idjabatan,jabatan,'' as karyawan FROM tjabatan"));*/
		$tableIds = DB::select( DB::raw("SELECT B.CODE,b.`nameof`,b.`urlpermission`, a.create,a.read,a.update,a.delete,
a.idjabatan,a.iddivisi,a.iddepartemen
FROM permission_role AS a LEFT JOIN permission AS b ON a.kdpermission = b.`fcode`
	
WHERE  (a.idjabatan =  '$idjabatan' and a.iddepartemen =  '$iddepartemen' and a.iddivisi =  '$iddivisi')  "));
				
        $jsonResult = array();

        for($i = 0;$i < count($tableIds);$i++)
        {
		    $jsonResult[$i]["kdpermission"] = $tableIds[$i]->CODE;
			$jsonResult[$i]["name_permission"] = $tableIds[$i]->nameof;
			$jsonResult[$i]["url_permission"] = $tableIds[$i]->urlpermission;
			$jsonResult[$i]["create"] = $tableIds[$i]->create;
			$jsonResult[$i]["read"] = $tableIds[$i]->read;
			$jsonResult[$i]["update"] = $tableIds[$i]->update;
			$jsonResult[$i]["delete"] = $tableIds[$i]->delete;

			
            
        }


		 if($jsonResult > 0){ //mengecek apakah data kosong atau tidak
				

		
        return $jsonResult;
				
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}

		}
			
		public function paginate($items,$perPage=2,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
}
