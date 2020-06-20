<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mpermission_role;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class cpermission_role extends Controller
{
		public function index(Request $request)
		{
		$search = $request->search; 
		$page = $request->page; 
		$sort = \Request::get('sort') ?: 'idpermission';
	/*	$tableIds = DB::select( DB::raw("SELECT idjabatan,jabatan,'' as permission_role FROM tjabatan"));*/
		$tableIds = DB::select( DB::raw("SELECT DISTINCT a.idpermission,c.idjabatan,c.jabatan as name,a.create,a.read,a.update,a.delete
FROM permission_role AS a LEFT JOIN tkaryawan AS b ON a.`idkaryawan` = b.`idkaryawan`
LEFT JOIN tjabatan AS c ON b.idjabatan = c.`idjabatan` where c.jabatan like '%" . $search . "%'"));
				
        $jsonResult = array();

        for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idrole"] = $tableIds[$i]->name;
			$jsonResult[$i]["name"] = $tableIds[$i]->name;
			$idjabatan = $tableIds[$i]->idjabatan;
			$jsonResult[$i]["acl"]= DB::select( DB::raw("SELECT DISTINCT a.create,a.read,a.update,a.delete
FROM permission_role AS a LEFT JOIN tkaryawan AS b ON a.`idkaryawan` = b.`idkaryawan`
LEFT JOIN tjabatan AS c ON b.idjabatan = c.`idjabatan` where c.idjabatan ='$idjabatan'"));

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
		
		
		
		public function store(Request $request){
		 $permission_role = new \App\mpermission_role();
		  $permission_role->idkaryawan = $request->idkaryawan;
		  $permission_role->read = $request->read;
		  $permission_role->create = $request->create;
		  $permission_role->update = $request->update;
		  $permission_role->delete = $request->delete;

		 if($permission_role->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$permission_role";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//

			 
		  $idkaryawan = $request->idkaryawan; 
		  $read = $request->read;
		  $create = $request->create;
		  $update = $request->update;
		  $delete = $request->delete;
		 $permission_role = \App\mpermission_role::where('idpermission',$id) ->update([
				 
				  'idkaryawan' => $idkaryawan, 
				  'read' =>  $read,
				  'create' =>  $create,
				  'update' =>  $update,
				  'delete' =>  $delete

			 ]);		 

			 
			$success=$permission_role;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$permission_role";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mpermission_role::where('idpermission',$id)->get();
		
			if(count($data) > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $data;
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		
		
		
		public function delete($id)
		{
			$data = \App\mpermission_role::where('idpermission',$id)->first();
		
			if($data->delete($id)){
				$res['message'] = "Success!";
				$res['value'] = "$data";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		
		
		
		
		
		
}
