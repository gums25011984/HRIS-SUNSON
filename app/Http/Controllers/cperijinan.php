<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mperijinan;
class cperijinan extends Controller
{
	  public function index()
		{
			//
			$data = \App\mperijinan::all();
		
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
		 $perijinan = new \App\mperijinan();
		 $perijinan->kode_perijinan = $request->kode_perijinan;
		 $perijinan->nama_perijinan = $request->nama_perijinan;
		 $perijinan->pot_gp = $request->pot_gp;
		 $perijinan->pot_tj = $request->pot_tj;
		 $perijinan->pot_ph = $request->pot_ph;
		 $perijinan->pot_pp = $request->pot_pp;
		 $perijinan->pot_rajin = $request->pot_rajin;
		 $perijinan->ket = $request->ket;
		 $perijinan->insert_by = $request->insert_by;
		 $perijinan->insert_time = $request->insert_time;
		 $perijinan->update_by = $request->update_by;
		 $perijinan->update_time = $request->update_time;
		 if($perijinan->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$perijinan";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			$kode_perijinan = $request->kode_perijinan;
			 $nama_perijinan = $request->nama_perijinan;
			 $pot_gp = $request->pot_gp;
			 $pot_tj = $request->pot_tj;
			 $pot_ph = $request->pot_ph;
			 $pot_pp = $request->pot_pp;
			 $pot_rajin = $request->pot_rajin;
			 $ket = $request->ket;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$perijinan = \App\mperijinan::where('idperijinan',$id) ->update([
			 	'kode_perijinan' => $kode_perijinan,
				'nama_perijinan' => $nama_perijinan,
				'pot_gp' =>$pot_gp,
				 'pot_tj' =>$pot_tj,
				 'pot_ph' =>$pot_ph,
				 'pot_pp' =>$pot_pp,
				 'pot_rajin' =>$pot_rajin,
			     'ket' =>$ket,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$perijinan;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$perijinan";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mperijinan::where('idperijinan',$id)->get();
		
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
			$data = \App\mperijinan::where('idperijinan',$id)->first();
		
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
