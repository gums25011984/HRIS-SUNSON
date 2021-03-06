<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\msubmenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class csubmenu extends Controller
{
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			
			$tableIds = DB::select("SELECT a.idmenuitem,a.code,a.fcode,a.nameof,a.filename,a.icon,b.nameof AS menu,@no:=@no+1 AS heh 
FROM sysappmenuitem AS a LEFT JOIN sysappmenu AS b ON a.fcode = b.code");

			$data=$this->paginate($tableIds,$perPage);
			$data->appends($request->all());
			return($data);
		}
		
		 public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator(array_values($items->forPage($page, $perPage)->toArray()), $items->count(), $perPage, $page, array('path' => Paginator::resolveCurrentPath()));
        //ref for array_values() fix: https://stackoverflow.com/a/38712699/3553367
    }		
		public function store(Request $request){
		 $submenu = new \App\msubmenu();
		 $submenu->code = $request->code;
		 $submenu->fcode = $request->fcode;
		 $submenu->nameof = $request->nameof;
		 $submenu->filename = $request->filename;
		 $submenu->icon = $request->icon;
		 $submenu->ketgroup = $request->ketgroup;
		 $submenu->grouplevel = $request->grouplevel;
		 $submenu->insert_by = $request->insert_by;
		 $submenu->insert_time = $request->insert_time;
		 $submenu->update_by = $request->update_by;
		 $submenu->update_time = $request->update_time;
		 if($submenu->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$submenu";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			 $code = $request->code;
			 $fcode = $request->fcode;
			 $nameof = $request->nameof;
			 $filename = $request->filename;
			 $icon = $request->icon;
			 $ketgroup = $request->ketgroup;
			 $grouplevel = $request->grouplevel;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$submenu = \App\msubmenu::where('idmenuitem',$id) ->update([
			 	'code' => $code,
				'fcode' => $fcode,
				'nameof' => $nameof,
				'filename' => $filename,
				'icon' => $icon,
				'ketgroup' => $ketgroup,
				'grouplevel' => $grouplevel,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,	
			 ]);		 

			 
			$success=$submenu;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$submenu";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\msubmenu::where('idmenuitem',$id)->get();
		
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
			$data = \App\msubmenu::where('idmenuitem',$id)->first();
		
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
