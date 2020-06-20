<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\msangsi;
class csangsi extends Controller
{
	  public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idsangsi';
			$data = \App\Msangsi::where('sangsi','like','%'.$search.'%')
			->orWhere('kdsangsi', 'like', "%".$search."%")->orderby($sort, 'asc')->paginate(1);
			/*$lastPage = $data->lastPage();
			if ($lastPage >= $page)
			{$page = 1;}
			else
			{$page =$lastPage;}*/
			/*$data = \App\Msangsi::where('sangsi','like','%'.$search.'%')
			->orWhere('kdsangsi', 'like', "%".$search."%")->orderby($sort, 'asc')->paginate(1);*/
			
			$data->appends($request->all());
			
			/*$data = \App\Msangsi::paginate($per_page);*/
			
		
			if(count($data) > 0){ //mengecek apakah data kosong atau tidak
				
				return response($data);
			}
			else{
				$res['message'] = count($data);
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
