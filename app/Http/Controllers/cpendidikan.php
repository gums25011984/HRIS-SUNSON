<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mpendidikan;

class cpendidikan extends Controller
{
	  public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idpendidikan';
			$data = \App\Mpendidikan::where('pendidikan','like',"%".$search."%")
			->orWhere('kdpendidikan', 'like', "%".$search."%")->orderby($sort, 'asc');
			$data=$data->paginate($perPage=$perPage,$columns='*',$pageName='page',$page=$page);
			/*$data = \App\Mpendidikan::paginate($per_page);*/
			
		
			if($data){ //mengecek apakah data kosong atau tidak
				$data->appends($request->all());
				return response($data);
			}
			
		}
		
		public function store(Request $request){
		 $pendidikan = new \App\mpendidikan();
		 $pendidikan->kdpendidikan = $request->kdpendidikan;
		 $pendidikan->pendidikan = $request->pendidikan;
		 $pendidikan->insert_by = $request->insert_by;
		 $pendidikan->insert_time = $request->insert_time;
		 $pendidikan->update_by = $request->update_by;
		 $pendidikan->update_time = $request->update_time;
		 if($pendidikan->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$pendidikan";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kdpendidikan = $request->kdpendidikan;
			 $pendidikan = $request->pendidikan;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$pendidikan = \App\mpendidikan::where('idpendidikan',$id) ->update([
			 	'kdpendidikan' => $kdpendidikan,
				'pendidikan' => $pendidikan,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$pendidikan;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$pendidikan";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mpendidikan::where('idpendidikan',$id)->get();
		
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
			$data = \App\mpendidikan::where('idpendidikan',$id)->first();
		
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
