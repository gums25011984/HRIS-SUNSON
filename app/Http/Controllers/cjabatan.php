<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mjabatan;
class cjabatan extends Controller
{
	 public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idjabatan';
			$data = \App\Mjabatan::where('jabatan','like',"%".$search."%")
			->orWhere('kdjabatan', 'like', "%".$search."%")->orderby($sort, 'asc')->paginate($page);
			/*$data = \App\Mjabatan::paginate($per_page);*/
			
		
			if(count($data) > 0){ //mengecek apakah data kosong atau tidak
				return response($data);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
		public function store(Request $request){
		 $jabatan = new \App\mjabatan();
		 $jabatan->kdjabatan = $request->kdjabatan;
		 $jabatan->jabatan = $request->jabatan;
		 $jabatan->insert_by = $request->insert_by;
		 $jabatan->insert_time = $request->insert_time;
		 $jabatan->update_by = $request->update_by;
		 $jabatan->update_time = $request->update_time;
		 if($jabatan->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$jabatan";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kdjabatan = $request->kdjabatan;
			 $jabatan = $request->jabatan;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$jabatan = \App\mjabatan::where('idjabatan',$id) ->update([
			 	'kdjabatan' => $kdjabatan,
				'jabatan' => $jabatan,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$jabatan;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$jabatan";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mjabatan::where('idjabatan',$id)->get();
		
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
			$data = \App\mjabatan::where('idjabatan',$id)->first();
		
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
