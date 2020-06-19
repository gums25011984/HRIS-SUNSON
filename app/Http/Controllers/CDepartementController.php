<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departement;
class CDepartementController extends Controller
{
	   public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'iddepartemen';
			$data = \App\MDepartement::where('departemen','like',"%".$search."%")
			->orWhere('kddepartemen', 'like', "%".$search."%")->orderby($sort, 'asc')->paginate($page);
			/*$data = \App\MDepartement::paginate($per_page);*/
			
		
			if(count($data) > 0){ //mengecek apakah data kosong atau tidak
				return response($data);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
		public function store(Request $request){
		 $departement = new \App\MDepartement();
		 $departement->kddepartemen = $request->kddepartemen;
		 $departement->departemen = $request->departemen;
		 $departement->insert_by = $request->insert_by;
		 $departement->insert_time = $request->insert_time;
		 $departement->update_by = $request->update_by;
		 $departement->update_time = $request->update_time;
		 if($departement->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$departement";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			
			$kddepartemen = $request->kddepartemen;
			 $departemen = $request->departemen;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$departement = \App\MDepartement::where('iddepartemen',$id) ->update([
			 	'kddepartemen' => $kddepartemen,
				'departemen' => $departemen,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$departement;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$departement";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		
		
		
		/*public function show($id)
		{
			$data = \App\MDepartement::where('iddepartemen',$id)->get();
		
			if(count($data) > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $data;
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}*/
		
		public function delete($id)
		{
			$data = \App\MDepartement::where('iddepartemen',$id)->first();
		
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
