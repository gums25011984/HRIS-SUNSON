<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mgapok;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class Cgapok extends Controller
{
	 public function index(Request $request)
		{
			$page = \Request::get('page') ?: 100;
			$perpage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$sort = \Request::get('sort') ?: 'idgapok';
			
			$tableIds = DB::select( DB::raw("SELECT a.idkaryawan,b.idgapok,c.kdstatus_kerja,a.nik,a.nama, 
b.gaji_pokok,b.tunj_jabatan,b.tunj_prestasi,b.tunj_fungsional,b.tunj_hadir,b.tunj_rajin,
b.tunj_masakerja,b.tunj_lainnya,
b.pot_astek, b.pot_spsi,b.pot_koperasi,b.pot_bisnis FROM tkaryawan AS a LEFT JOIN tgapok AS b ON a.idkaryawan = b.idkaryawan
left join tstatus_kerja as c ON a.idstatus_kerja = c.idstatus_kerja where a.nama like '" . $search . "%' or a.nik like '" . $search . "%' or a.jk like '" . $search . "%'    or c.kdstatus_kerja like '" . $search . "%'"));

		$jsonResult = array();
		
		for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idkaryawan"] = $tableIds[$i]->idkaryawan;
			$jsonResult[$i]["idgapok"] = $tableIds[$i]->idgapok;
			$jsonResult[$i]["kdstatus_kerja"] = $tableIds[$i]->kdstatus_kerja;
			$jsonResult[$i]["nik"] = $tableIds[$i]->nik;
			$jsonResult[$i]["nama"] = $tableIds[$i]->nama;
			$jsonResult[$i]["gaji_pokok"] = $tableIds[$i]->gaji_pokok;
			$jsonResult[$i]["tunj_jabatan"] = $tableIds[$i]->tunj_jabatan;
			
			$jsonResult[$i]["tunj_prestasi"] = $tableIds[$i]->tunj_prestasi;
			$jsonResult[$i]["tunj_fungsional"] = $tableIds[$i]->tunj_fungsional;
			$jsonResult[$i]["tunj_hadir"] = $tableIds[$i]->tunj_hadir;
			$jsonResult[$i]["tunj_rajin"] = $tableIds[$i]->tunj_rajin;
			$jsonResult[$i]["tunj_masakerja"] = $tableIds[$i]->tunj_masakerja;
			$jsonResult[$i]["tunj_lainnya"] = $tableIds[$i]->tunj_lainnya;
			$jsonResult[$i]["pot_astek"] = $tableIds[$i]->pot_astek;
			
			$jsonResult[$i]["pot_spsi"] = $tableIds[$i]->pot_spsi;
			$jsonResult[$i]["pot_koperasi"] = $tableIds[$i]->pot_koperasi;
			$jsonResult[$i]["pot_bisnis"] = $tableIds[$i]->pot_bisnis;
			
		 }
		 $data = $this->paginate($jsonResult,$page,$perpage);
		
        return $data;
		}
		
		
		
	public function paginate($items,$page,$perPage,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
		
		public function store(Request $request){
		 $gapok = new \App\mgapok();
		 $gapok->idkaryawan = $request->idkaryawan;
		 $gapok->gaji_pokok = $request->gaji_pokok;
		 $gapok->tunj_jabatan = $request->tunj_jabatan;
		 $gapok->tunj_prestasi = $request->tunj_prestasi;
		 $gapok->tunj_shift = $request->tunj_shift;
		 $gapok->tunj_fungsional = $request->tunj_fungsional;
		 $gapok->tunj_hadir = $request->tunj_hadir;
		 $gapok->tunj_rajin = $request->tunj_rajin;
		 $gapok->tunj_masakerja = $request->tunj_masakerja;
		 $gapok->tunj_lainnya = $request->tunj_lainnya;
		 $gapok->pot_astek = $request->pot_astek;
		 $gapok->pot_spsi = $request->pot_spsi;
		 $gapok->pot_koperasi = $request->pot_koperasi;
		 $gapok->pot_bisnis = $request->pot_bisnis;
		 $gapok->insert_by = $request->insert_by;
		 $gapok->insert_time = $request->insert_time;
		 $gapok->update_by = $request->update_by;
		 $gapok->update_time = $request->update_time;
		 if($gapok->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$gapok";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			 $idkaryawan = $request->idkaryawan;
			 $gaji_pokok = $request->gaji_pokok;
			 $tunj_jabatan = $request->tunj_jabatan;
			 $tunj_prestasi = $request->tunj_prestasi;
			 $tunj_shift = $request->tunj_shift;
			 $tunj_fungsional = $request->tunj_fungsional;
			 $tunj_hadir = $request->tunj_hadir;
			 $tunj_rajin = $request->tunj_rajin;
			 $tunj_masakerja = $request->tunj_masakerja;
			 $tunj_lainnya = $request->tunj_lainnya;
			 $pot_astek = $request->pot_astek;
			 $pot_spsi = $request->pot_spsi;
			 $pot_koperasi = $request->pot_koperasi;
			 $pot_bisnis = $request->pot_bisnis;
			 $insert_by = $request->insert_by;
			 $insert_time = $request->insert_time;
			 $update_by = $request->update_by;
			 $update_time = $request->update_time;
			 
			
			$gapok = \App\mgapok::where('idgapok',$id) ->update([
				 'idkaryawan' => $idkaryawan,
				 'gaji_pokok' => $gaji_pokok,
				 'tunj_jabatan' => $tunj_jabatan,
				 'tunj_prestasi' => $tunj_prestasi,
				 'tunj_shift' => $tunj_shift,
				 'tunj_fungsional' => $tunj_fungsional,
				 'tunj_hadir' => $tunj_hadir,
				 'tunj_rajin' => $tunj_rajin,
				 'tunj_masakerja' => $tunj_masakerja,
				 'tunj_lainnya' => $tunj_lainnya,
				 'pot_astek' => $pot_astek,
				 'pot_spsi' => $pot_spsi,
				 'pot_koperasi' => $pot_koperasi,
				 'pot_bisnis' => $pot_bisnis,
				 'insert_by' => $insert_by,
				 'insert_time' => $insert_time,
				 'update_by' => $update_by,
				 'update_time' => $update_time,
			 ]);		 

			 
			$success=$gapok;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$gapok";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mgapok::where('idgapok',$id)->get();
		
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
			$data = \App\mgapok::where('idgapok',$id)->first();
		
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
