<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\muser;
class cuser extends Controller
{
	  public function index()
		{
			//
			$data = \App\muser::all();
		
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
		 $user = new \App\muser();
		 $user->idkaryawan = $request->idkaryawan;
		 $user->nik = $request->nik;
		 $user->username = $request->username;
		 $user->nama = $request->nama;
		 $user->password = $request->password;
		 $user->insert_by = $request->insert_by;
		 $user->insert_time = $request->insert_time;
		 $user->update_by = $request->update_by;
		 $user->update_time = $request->update_time;
		 if($user->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$user";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			 $idkaryawan = $request->idkaryawan;
			 $nik = $request->nik;
			 $username = $request->username;
			 $nama = $request->nama;
			 $password = $request->password;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$user = \App\muser::where('iduser',$id) ->update([
			 	'idkaryawan' => $idkaryawan,
				'nik' => $nik,
				'username' => $username,
				'nama' => $nama,
				'password' => $password,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$user;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$user";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\muser::where('iduser',$id)->get();
		
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
			$data = \App\muser::where('iduser',$id)->first();
		
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
