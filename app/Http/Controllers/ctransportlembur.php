<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mtransportlembur;
class ctransportlembur extends Controller
{
	 public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'jurusan';
			$data = \App\Mtransportlembur::where('jurusan','like',"%".$search."%")->orderby($sort, 'asc');
			$data=$data->paginate($perPage=$perPage,$columns='*',$pageName='page',$page=$page);
			/*$data = \App\Mtransport_lembur::paginate($per_page);*/
			
		
			if($data){ //mengecek apakah data kosong atau tidak
			$data->appends($request->all());
				return response($data);
			}
			
		}
		
		public function store(Request $request){
		 $transportlembur = new \App\mtransportlembur();
		 $transportlembur->nominal = $request->nominal;
		 $transportlembur->jurusan = $request->jurusan;
		 $transportlembur->insert_by = $request->insert_by;
		 $transportlembur->insert_time = $request->insert_time;
		 $transportlembur->update_by = $request->update_by;
		 $transportlembur->update_time = $request->update_time;
		 if($transportlembur->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$transportlembur";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$nominal = $request->nominal;
			 $jurusan = $request->jurusan;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$transportlembur = \App\mtransportlembur::where('idtransportlembur',$id) ->update([
			 	'nominal' => $nominal,
				'jurusan' => $jurusan,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$transportlembur;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$transportlembur";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mtransportlembur::where('idtransportlembur',$id)->get();
		
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
			$data = \App\mtransportlembur::where('idtransportlembur',$id)->first();
		
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
