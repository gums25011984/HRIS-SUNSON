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
	
WHERE idmenuitem IS NOT NULL and (a.idjabatan =  '$idjabatan' or a.iddepartemen =  '$iddepartemen' or a.iddivisi =  '$iddivisi')  "));
				
        $jsonResult = array();

        for($i = 0;$i < count($tableIds);$i++)
        {
		    $jsonResult[$i]["idaccess"] = $tableIds[$i]->idaccess;
			$jsonResult[$i]["nameof"] = $tableIds[$i]->nameof;
			$jsonResult[$i]["filename"] = $tableIds[$i]->filename;
			$jsonResult[$i]["create"] = $tableIds[$i]->create;
			$jsonResult[$i]["read"] = $tableIds[$i]->read;
			$jsonResult[$i]["update"] = $tableIds[$i]->update;
			$jsonResult[$i]["delete"] = $tableIds[$i]->delete;

			
            
        }

		 if($jsonResult > 0){ //mengecek apakah data kosong atau tidak
				
				$article = collect($jsonResult);
				$article = $article->sortBy($sort);
				$res = $this->paginate($article,$page);
				return response($res);
				
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}

		}
			
		public function paginate($items,$page,$pageStart=1)
		{
			$page = \Request::get('page') ?: 100;
			$currentPage = LengthAwarePaginator::resolveCurrentPage();
			$currentResults = $items->slice(($currentPage - 1) * $page, $page)->all();
			return new LengthAwarePaginator($currentResults, count($items), $page,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
		}
}
