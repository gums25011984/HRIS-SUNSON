<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\msangsi;
class csangsi extends Controller
{
	  public function index()
		{
			//
			$data = \App\msangsi::all();
		
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
		 $sangsi = new \App\msangsi();
		 $sangsi->kdsangsi = $request->kdsangsi;
		 $sangsi->sangsi = $request->sangsi;
		 $sangsi->insert_by = $request->insert_by;
		 $sangsi->insert_time = $request->insert_time;
		 $sangsi->update_by = $request->update_by;
		 $sangsi->update_time = $request->update_time;
		 if($sangsi->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$sangsi";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kdsangsi = $request->kdsangsi;
			 $sangsi = $request->sangsi;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$sangsi = \App\msangsi::where('idsangsi',$id) ->update([
			 	'kdsangsi' => $kdsangsi,
				'sangsi' => $sangsi,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$sangsi;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$sangsi";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\msangsi::where('idsangsi',$id)->get();
		
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
			$data = \App\msangsi::where('idsangsi',$id)->first();
		
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
