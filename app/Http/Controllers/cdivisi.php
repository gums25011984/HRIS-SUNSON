<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdivisi;
class Cdivisi extends Controller
{
	  public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'iddivisi';
			
			$data = \App\Mdivisi::where('divisi','like',"%".$search."%")
			->orWhere('kddivisi', 'like', "%".$search."%")->orderby($sort, 'asc');
			$data=$data->paginate($perPage=$perPage,$columns='*',$pageName='page',$page=$page);
			/*$data = \App\Mdivisi::paginate($per_page);*/
			
		
			if($data){ //mengecek apakah data kosong atau tidak
				$data->appends($request->all());
				return response($data);
			}
			
			
			
			
			
		}
		
		public function store(Request $request){
		 $divisi = new \App\mdivisi();
		 $divisi->kddivisi = $request->kddivisi;
		 $divisi->divisi = $request->divisi;
		 $divisi->insert_by = $request->insert_by;
		 $divisi->insert_time = $request->insert_time;
		 $divisi->update_by = $request->update_by;
		 $divisi->update_time = $request->update_time;
		 if($divisi->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$divisi";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kddivisi = $request->kddivisi;
			 $divisi = $request->divisi;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$divisi = \App\mdivisi::where('iddivisi',$id) ->update([
			 	'kddivisi' => $kddivisi,
				'divisi' => $divisi,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$divisi;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$divisi";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mdivisi::where('iddivisi',$id)->get();
		
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
			$data = \App\mdivisi::where('iddivisi',$id)->first();
		
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
