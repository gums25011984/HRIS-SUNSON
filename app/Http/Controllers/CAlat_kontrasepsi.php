<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MAlat_Kontrasepsi;
class CAlat_Kontrasepsi extends Controller
{
	 public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idalat_kontrasepsi';
			$data = \App\Malat_kontrasepsi::where('alat_kontrasepsi','like',"%".$search."%")
			->orWhere('kdalat_kontrasepsi', 'like', "%".$search."%")->orderby($sort, 'asc')->paginate($page);
			/*$data = \App\Malat_kontrasepsi::paginate($per_page);*/
			
		
			if(count($data) > 0){ //mengecek apakah data kosong atau tidak
				return response($data);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
		public function store(Request $request){
		 $alat_kontrasepsi = new \App\MAlat_Kontrasepsi();
		 $alat_kontrasepsi->kdalat_kontrasepsi = $request->kdalat_kontrasepsi;
		 $alat_kontrasepsi->alat_kontrasepsi = $request->alat_kontrasepsi;
		 $alat_kontrasepsi->insert_by = $request->insert_by;
		 $alat_kontrasepsi->insert_time = $request->insert_time;
		 $alat_kontrasepsi->update_by = $request->update_by;
		 $alat_kontrasepsi->update_time = $request->update_time;
		 if($alat_kontrasepsi->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$alat_kontrasepsi";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kdalat_kontrasepsi = $request->kdalat_kontrasepsi;
			 $alat_kontrasepsi = $request->alat_kontrasepsi;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$alat_kontrasepsi = \App\MAlat_Kontrasepsi::where('idalat_kontrasepsi',$id) ->update([
			 	'kdalat_kontrasepsi' => $kdalat_kontrasepsi,
				'alat_kontrasepsi' => $alat_kontrasepsi,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$alat_kontrasepsi;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$alat_kontrasepsi";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\MAlat_Kontrasepsi::where('idalat_kontrasepsi',$id)->get();
		
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
			$data = \App\MAlat_Kontrasepsi::where('idalat_kontrasepsi',$id)->first();
		
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
