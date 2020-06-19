<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\mjadwal_kerja;
class cjadwal_kerja extends Controller
{
	   public function index(Request $request)
		{
			$search = $request->search; 
			$page = $request->page; 
			$sort = \Request::get('sort') ?: 'idjadwal_kerja';
			$tableIds = DB::select("SELECT a.idjadwal_kerja,a.tgl,b.mgroup_kerja,c.parameter from tjadwal_kerja as a left join
		tmgroup_kerja as b ON a.idmgroup_kerja = b.idmgroup_kerja left join tparameter as c on a.idparameter = c.idparameter where (c.parameter like '" . $search . "%' or b.mgroup_kerja like '" . $search . "%' )");

			$jsonResult = array();
		
		for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idjadwal_kerja"] = $tableIds[$i]->idjadwal_kerja;
			$jsonResult[$i]["tgl"] = $tableIds[$i]->tgl;
			$jsonResult[$i]["mgroup_kerja"] = $tableIds[$i]->mgroup_kerja;
			$jsonResult[$i]["parameter"] = $tableIds[$i]->parameter;
			
			
		 }
		if($jsonResult > 0){ //mengecek apakah data kosong atau tidak
				
				$article = collect($jsonResult);
				$article = $article->sortBy($sort);
				$res = $this->paginate($article,$page);
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}

		}
			
		public function paginate($items,$page,$pageStart=1)
		{
			$page = \Request::get('page') ?: 100;
			$currentPage = LengthAwarePaginator::resolveCurrentPage();
			$currentResults = $items->slice(($currentPage - 1) * $page, $page)->all();
			return new LengthAwarePaginator($currentResults, count($items), $page,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
		}
		
		
		public function store(Request $request){
		 $jadwal_kerja = new \App\mjadwal_kerja();
		 $jadwal_kerja->tgl = $request->tgl;
		 $jadwal_kerja->idmgroup_kerja = $request->idmgroup_kerja;
		 $jadwal_kerja->idparameter = $request->idparameter;
		
		 $jadwal_kerja->insert_by = $request->insert_by;
		 $jadwal_kerja->insert_time = $request->insert_time;
		 $jadwal_kerja->update_by = $request->update_by;
		 $jadwal_kerja->update_time = $request->update_time;
		 if($jadwal_kerja->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$jadwal_kerja";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//

			 $tgl = $request->tgl;
			 $idmgroup_kerja = $request->idmgroup_kerja;
			 $idparameter = $request->idparameter;
			 
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$jadwal_kerja = \App\mjadwal_kerja::where('idjadwal_kerja',$id) ->update([
			 	 
				 'tgl' => $tgl,
				 'idmgroup_kerja' => $idmgroup_kerja,
				 'idparameter' => $idparameter,
				 
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,
			 ]);		 

			 
			$success=$jadwal_kerja;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$jadwal_kerja";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mjadwal_kerja::where('idjadwal_kerja',$id)->get();
		
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
			$data = \App\mjadwal_kerja::where('idjadwal_kerja',$id)->first();
		
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
