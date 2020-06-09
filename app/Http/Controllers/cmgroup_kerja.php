<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mmgroup_kerja;
class cmgroup_kerja extends Controller
{
	  public function index()
		{
			//
			$data = \App\mmgroup_kerja::all();
		
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
		 $mgroup_kerja = new \App\mmgroup_kerja();
		 $mgroup_kerja->kdmgroup_kerja = $request->kdmgroup_kerja;
		 $mgroup_kerja->mgroup_kerja = $request->mgroup_kerja;
		 $mgroup_kerja->insert_by = $request->insert_by;
		 $mgroup_kerja->insert_time = $request->insert_time;
		 $mgroup_kerja->update_by = $request->update_by;
		 $mgroup_kerja->update_time = $request->update_time;
		 if($mgroup_kerja->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$mgroup_kerja";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kdmgroup_kerja = $request->kdmgroup_kerja;
			 $mgroup_kerja = $request->mgroup_kerja;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$mgroup_kerja = \App\mmgroup_kerja::where('idmgroup_kerja',$id) ->update([
			 	'kdmgroup_kerja' => $kdmgroup_kerja,
				'mgroup_kerja' => $mgroup_kerja,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$mgroup_kerja;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$mgroup_kerja";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mmgroup_kerja::where('idmgroup_kerja',$id)->get();
		
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
			$data = \App\mmgroup_kerja::where('idmgroup_kerja',$id)->first();
		
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
