<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mstatus_kerja;
class cstatus_kerja extends Controller
{
	   public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 100;
			$search = $request->search;
			$data = \App\Mstatus_kerja::where('status_kerja','like',"%".$search."%")
			->orWhere('kdstatus_kerja', 'like', "%".$search."%")->paginate($page);
			/*$data = \App\Mstatus_kerja::paginate($per_page);*/
			
		
			if(count($data) > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $data;
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
		public function store(Request $request){
		 $status_kerja = new \App\mstatus_kerja();
		 $status_kerja->kdstatus_kerja = $request->kdstatus_kerja;
		 $status_kerja->status_kerja = $request->status_kerja;
		 $status_kerja->insert_by = $request->insert_by;
		 $status_kerja->insert_time = $request->insert_time;
		 $status_kerja->update_by = $request->update_by;
		 $status_kerja->update_time = $request->update_time;
		 if($status_kerja->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$status_kerja";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kdstatus_kerja = $request->kdstatus_kerja;
			 $status_kerja = $request->status_kerja;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$status_kerja = \App\mstatus_kerja::where('idstatus_kerja',$id) ->update([
			 	'kdstatus_kerja' => $kdstatus_kerja,
				'status_kerja' => $status_kerja,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$status_kerja;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$status_kerja";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mstatus_kerja::where('idstatus_kerja',$id)->get();
		
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
			$data = \App\mstatus_kerja::where('idstatus_kerja',$id)->first();
		
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
