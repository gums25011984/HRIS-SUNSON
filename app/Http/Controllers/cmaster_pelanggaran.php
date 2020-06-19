<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mmaster_pelanggaran;
class cmaster_pelanggaran extends Controller
{
	 public function index(Request $request)
		{
			$page = \Request::get('page') ?: 100;
			$search = $request->search;
			$sort = $request->sort;
			$data = \App\Mmaster_pelanggaran::where('master_pelanggaran','like',"%".$search."%")
			->orWhere('kdmaster_pelanggaran', 'like', "%".$search."%")->orderby($sort, 'asc')->paginate($page);
			/*$data = \App\Mmaster_pelanggaran::paginate($per_page);*/
			
		
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
		 $master_pelanggaran = new \App\mmaster_pelanggaran();
		 $master_pelanggaran->kdmaster_pelanggaran = $request->kdmaster_pelanggaran;
		 $master_pelanggaran->master_pelanggaran = $request->master_pelanggaran;
		 $master_pelanggaran->insert_by = $request->insert_by;
		 $master_pelanggaran->insert_time = $request->insert_time;
		 $master_pelanggaran->update_by = $request->update_by;
		 $master_pelanggaran->update_time = $request->update_time;
		 if($master_pelanggaran->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$master_pelanggaran";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kdmaster_pelanggaran = $request->kdmaster_pelanggaran;
			 $master_pelanggaran = $request->master_pelanggaran;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$master_pelanggaran = \App\mmaster_pelanggaran::where('idmaster_pelanggaran',$id) ->update([
			 	'kdmaster_pelanggaran' => $kdmaster_pelanggaran,
				'master_pelanggaran' => $master_pelanggaran,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$master_pelanggaran;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$master_pelanggaran";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mmaster_pelanggaran::where('idmaster_pelanggaran',$id)->get();
		
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
			$data = \App\mmaster_pelanggaran::where('idmaster_pelanggaran',$id)->first();
		
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
