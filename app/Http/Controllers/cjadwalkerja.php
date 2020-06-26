<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mkaryawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class cjadwalkerja extends Controller
{
		 public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;

			$mgroup_kerja = $request->mgroup_kerja;
			$tahun = $request->tahun;
			$bulan = $request->bulan;
			$perPage = \Request::get('perpage') ?: 100; 
			$sort = \Request::get('sort') ?: 'idjadwal_kerja';
			
			$tableIds = DB::select("SELECT a.idjadwal_kerja,a.tgl AS startDate,a.tglend AS endDate,
CONCAT(b.parameter, ' (', LEFT(b.work_start,5),'-', LEFT(b.work_end,5),')') as title FROM tjadwal_kerja AS a LEFT JOIN tparameter AS b ON a.idparameter = b.idparameter LEFT JOIN tmgroup_kerja AS c ON a.idmgroup_kerja = c.idmgroup_kerja WHERE 
c.mgroup_kerja='$mgroup_kerja' and YEAR(tglend)='$tahun'");

			/*$data=$this->paginate($tableIds,$perPage);
		$data->appends($request->all());*/
		return($tableIds);
		}
		
		 public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator(array_values($items->forPage($page, $perPage)->toArray()), $items->count(), $perPage, $page, array('path' => Paginator::resolveCurrentPath()));
        //ref for array_values() fix: https://stackoverflow.com/a/38712699/3553367
    }
		

		
		
		
		public function store(Request $request){
		 $jadwal_kerja = new \App\mjadwal_kerja();
		 $jadwal_kerja->tgl = $request->tgl;
		 $jadwal_kerja->tglend = $request->tglend;
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
			 $tglend = $request->tglend;
			 $idmgroup_kerja = $request->idmgroup_kerja;
			 $idparameter = $request->idparameter;
				 
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$jadwal_kerja = \App\mjadwal_kerja::where('idjadwal_kerja',$id) ->update([
			 	 
				 'tgl' => $tgl,
				 'tglend' => $tglend,
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
