<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mlibur_nasional;
class clibur_nasional extends Controller
{
	   public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idlibur_nasional';
			$data = \App\Mlibur_nasional::where('libur_nasional','like',"%".$search."%")
			->orWhere('kdlibur_nasional', 'like', "%".$search."%")->orderby($sort, 'asc')->paginate($page);
			/*$data = \App\Mlibur_nasional::paginate($per_page);*/
			
		
			if(count($data) > 0){ //mengecek apakah data kosong atau tidak
				return response($data);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
		public function store(Request $request){
		 $libur_nasional = new \App\mlibur_nasional();
		 $libur_nasional->kdlibur_nasional = $request->kdlibur_nasional;
		 $libur_nasional->tgl = $request->tgl;
		 $libur_nasional->libur_nasional = $request->libur_nasional;
		 $libur_nasional->insert_by = $request->insert_by;
		 $libur_nasional->insert_time = $request->insert_time;
		 $libur_nasional->update_by = $request->update_by;
		 $libur_nasional->update_time = $request->update_time;
		 if($libur_nasional->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$libur_nasional";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			 $kdlibur_nasional = $request->kdlibur_nasional;
			 $tgl = $request->tgl;
			 $libur_nasional = $request->libur_nasional;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$libur_nasional = \App\mlibur_nasional::where('idlibur_nasional',$id) ->update([
			 	'kdlibur_nasional' => $kdlibur_nasional,
				'tgl' => $tgl,
				'libur_nasional' => $libur_nasional,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$libur_nasional;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$libur_nasional";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mlibur_nasional::where('idlibur_nasional',$id)->get();
		
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
			$data = \App\mlibur_nasional::where('idlibur_nasional',$id)->first();
		
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
