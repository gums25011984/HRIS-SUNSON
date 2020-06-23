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
		$sort = \Request::get('sort') ?: 'idaccess';
	/*	$tableIds = DB::select( DB::raw("SELECT idjabatan,jabatan,'' as karyawan FROM tjabatan"));*/
		$tableIds = DB::select( DB::raw("SELECT  b.idaccess,a.idpermission,a.idjabatan,d.idmenuitem,f.departemen,g.divisi,a.idjabatan,a.iddivisi,a.iddepartemen,
	d.nameof ,d.filename ,a.read,a.create,a.update,a.delete
	FROM permission_role AS a 
	
	  LEFT JOIN sysuseraccess AS b ON a.idjabatan = b.`idjabatan`
	LEFT JOIN sysappmenuitem AS d ON b.`fcode` = d.`code`  LEFT JOIN sysappmenu AS e ON e.`code` = d.`fcode`
	LEFT JOIN tdepartemen AS f ON a.`iddepartemen` = f.`iddepartemen` LEFT JOIN tdivisi AS g ON a.`iddivisi` = g.`iddivisi`
	
WHERE idmenuitem IS NOT NULL and (a.idjabatan =  '$idjabatan' and a.iddepartemen =  '$iddepartemen' and a.iddivisi =  '$iddivisi')  "));
				
        $jsonResult = array();

        for($i = 0;$i < count($tableIds);$i++)
        {
		    $jsonResult[$i]["id_permission"] = $tableIds[$i]->idaccess;
			$jsonResult[$i]["name_permission"] = $tableIds[$i]->nameof;
			$jsonResult[$i]["url_permission"] = $tableIds[$i]->filename;
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
        $offSet = ($page* $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
}
