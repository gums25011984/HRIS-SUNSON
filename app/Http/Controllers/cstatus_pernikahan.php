<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mstatus_pernikahan;
class cstatus_pernikahan extends Controller
{
	  public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idstatus_pernikahan';
			$data = \App\Mstatus_pernikahan::where('status_pernikahan','like',"%".$search."%")
			->orWhere('kdstatus_pernikahan', 'like', "%".$search."%")->orderby($sort, 'asc');
			$data=$data->paginate($perPage=$perPage,$columns='*',$pageName='page',$page=$page);
			/*$data = \App\Mstatus_pernikahan::paginate($per_page);*/
			
		
			if($data){ //mengecek apakah data kosong atau tidak
				$data->appends($request->all());
				return response($data);
			}
			
		}
		
		public function store(Request $request){
		 $status_pernikahan = new \App\mstatus_pernikahan();
		 $status_pernikahan->kdstatus_pernikahan = $request->kdstatus_pernikahan;
		 $status_pernikahan->status_pernikahan = $request->status_pernikahan;
		 $status_pernikahan->insert_by = $request->insert_by;
		 $status_pernikahan->insert_time = $request->insert_time;
		 $status_pernikahan->update_by = $request->update_by;
		 $status_pernikahan->update_time = $request->update_time;
		 if($status_pernikahan->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$status_pernikahan";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kdstatus_pernikahan = $request->kdstatus_pernikahan;
			 $status_pernikahan = $request->status_pernikahan;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$status_pernikahan = \App\mstatus_pernikahan::where('idstatus_pernikahan',$id) ->update([
			 	'kdstatus_pernikahan' => $kdstatus_pernikahan,
				'status_pernikahan' => $status_pernikahan,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$status_pernikahan;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$status_pernikahan";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mstatus_pernikahan::where('idstatus_pernikahan',$id)->get();
		
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
			$data = \App\mstatus_pernikahan::where('idstatus_pernikahan',$id)->first();
		
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
