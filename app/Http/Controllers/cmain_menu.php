<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mmain_menu;
class cmain_menu extends Controller
{
	  public function index()
		{
			//
			$data = \App\mmain_menu::all();
		
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
		 $mainmenu = new \App\mmain_menu();
		 $mainmenu->code = $request->code;
		 $mainmenu->nameof = $request->nameof;
		 $mainmenu->page = $request->page;
		 $mainmenu->icon = $request->icon;
		 $mainmenu->submenu = $request->submenu;
		 $mainmenu->insert_by = $request->insert_by;
		 $mainmenu->insert_time = $request->insert_time;
		 $mainmenu->update_by = $request->update_by;
		 $mainmenu->update_time = $request->update_time;
		 if($mainmenu->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$mainmenu";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			 $code = $request->code;
			 $nameof = $request->nameof;
			 $page = $request->page;
			 $icon = $request->icon;
			 $submenu = $request->submenu;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$mainmenu = \App\mmain_menu::where('idmenu',$id) ->update([
			 	'code' => $code,
				'nameof' => $nameof,
				'page' => $page,
				'icon' => $icon,
				'submenu' => $submenu,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$mainmenu;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$mainmenu";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mmain_menu::where('idmenu',$id)->get();
		
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
			$data = \App\mmain_menu::where('idmenu',$id)->first();
		
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
