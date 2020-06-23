<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mparameter;
class cparameter extends Controller
{
	 public function index(Request $request)
		{
			//
			$page = \Request::get('page') ?: 100;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idparameter';
			$data = \App\Mparameter::where('parameter','like',"%".$search."%")
			->orWhere('kdparameter', 'like', "%".$search."%")->orderby($sort, 'asc');
			$data=$data->paginate($perPage=$perPage,$columns='*',$pageName='page',$page=$page);
			/*$data = \App\Mparameter::paginate($per_page);*/
			
		
			if($data){ //mengecek apakah data kosong atau tidak
				$data->appends($request->all());
				return response($data);
			}
			
		}
		
		
		
		
		
		public function store(Request $request){
		 $parameter = new \App\mparameter();
		 $parameter->kdparameter = $request->kdparameter;
		 $parameter->parameter = $request->parameter;
		 $parameter->absen_start = $request->absen_start;
		 $parameter->absen_end = $request->absen_end;
		 $parameter->work_start = $request->work_start;
		 $parameter->work_end = $request->work_end;
		 $parameter->ot1_start = $request->ot1_start;
		 $parameter->ot1_end = $request->ot1_end;
		 $parameter->ot2_start = $request->ot2_start;
		 $parameter->ot2_end = $request->ot2_end;
		 $parameter->break1_start = $request->break1_start;
		 $parameter->break1_end = $request->break1_end;
		 $parameter->break2_start = $request->break2_start;
		 $parameter->break2_end = $request->break2_end;
		 $parameter->ket = $request->ket;
		 $parameter->insert_by = $request->insert_by;
		 $parameter->insert_time = $request->insert_time;
		 $parameter->update_by = $request->update_by;
		 $parameter->update_time = $request->update_time;
		 if($parameter->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$parameter";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//

			 $kdparameter = $request->kdparameter;
			 $parameter = $request->parameter;
			 $absen_start = $request->absen_start;
			 $absen_end = $request->absen_end;
			 $work_start = $request->work_start;
			 $work_end = $request->work_end;
			 $ot1_start = $request->ot1_start;
			 $ot1_end = $request->ot1_end;
			 $ot2_start = $request->ot2_start;
			 $ot2_end = $request->ot2_end;
			 $break1_start = $request->break1_start;
			 $break1_end = $request->break1_end;
			 $break2_start = $request->break2_start;
			 $break2_end = $request->break2_end;
			 $ket = $request->ket;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$parameter = \App\mparameter::where('idparameter',$id) ->update([
			 	 
				 'kdparameter' => $kdparameter,
				 'parameter' => $parameter,
				 'absen_start' => $absen_start,
				 'absen_end' => $absen_end,
				 'work_start' => $work_start,
				 'work_end' => $work_end,
				 'ot1_start' => $ot1_start,
				 'ot1_end' => $ot1_end,
				 'ot2_start' => $ot2_start,
				 'ot2_end' => $ot2_end,
				 'break1_start' => $break1_start,
				 'break1_end' => $break1_end,
				 'break2_start' => $break2_start,
				 'break2_end' => $break2_end,
				 'ket' => $ket,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,
			 ]);		 

			 
			$success=$parameter;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$parameter";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mparameter::where('idparameter',$id)->get();
		
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
			$data = \App\mparameter::where('idparameter',$id)->first();
		
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
