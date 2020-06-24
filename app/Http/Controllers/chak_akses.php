<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mhak_akses;
class Chak_akses extends Controller
{
	 public function index(Request $request)
		{
			//
			$per_page = \Request::get('per_page') ?: 100;
			$data = \App\mhak_akses::paginate($per_page);

		
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idjabatan';
			$data = \App\mhak_akses::where('fcode','like',"%".$search."%")->orderby($sort, 'asc');
			$data=$data->paginate($perPage=$perPage,$columns='*',$pageName='page',$page=$page);
			/*$data = \App\Mtransport_lembur::paginate($per_page);*/
			
		
			if($data){ //mengecek apakah data kosong atau tidak
			$data->appends($request->all());
				return response($data);
			}
		}
		
		public function store(Request $request){
		 $hak_akses = new \App\mhak_akses();
		 $hak_akses->idjabatan = $request->kdhak_akses;
		 $hak_akses->fcode = $request->hak_akses;
		
		 $hak_akses->update_by = $request->update_by;
		 $hak_akses->update_time = $request->update_time;
		 if($hak_akses->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$hak_akses";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$idjabatan = $request->idjabatan;
			 $fcode = $request->fcode;

			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$hak_akses = \App\mhak_akses::where('idjabatan',$id) ->update([
			 	'idjabatan' => $idjabatan,
				'fcode' => $fcode,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$hak_akses;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$hak_akses";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mhak_akses::where('idjabatan',$id)->get();
		
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
			$data = \App\mhak_akses::where('idjabatan',$id)->first();
		
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
