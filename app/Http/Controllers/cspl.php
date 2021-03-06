<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\mspl;
class cspl extends Controller
{
	 public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			
			$tableIds = DB::select("SELECT a.idspl,a.`nospl`,a.tgl,b.nama AS leader,a.jam,a.`jam_mulai`,a.`jam_berakhir`,c.nama AS manager,a.acc,a. ket FROM tspl AS a LEFT JOIN tkaryawan AS b ON a.`permintaan_dari` = b.idkaryawan LEFT JOIN tkaryawan AS c ON a.`idmanager` = c.idkaryawan");
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
		  $spl = new \App\mspl();
		  $spl->tgl = $request->tgl;
		  $spl->nospl = $request->nospl;
		  $spl->permintaan_dari = $request->permintaan_dari;
		  $spl->jam = $request->jam;
		  $spl->jam_mulai = $request->jam_mulai;
		  $spl->jam_berakhir = $request->jam_berakhir;
		  $spl->idkabag = $request->idkabag;
		  $spl->tglacc_kabag = $request->tglacc_kabag;
		  $spl->ket_kabag = $request->ket_kabag;
		  $spl->idkadep = $request->idkadep;
		  $spl->tglacc_kadep = $request->tglacc_kadep;
		  $spl->ket_kadep = $request->ket_kadep;
		  $spl->idmanager = $request->idmanager;
		  $spl->tglacc_manager = $request->tglacc_manager;
		  $spl->ket_manager = $request->ket_manager;
		  $spl->acc = $request->acc;
		  $spl->ket = $request->ket;
		  
		  $spl->insert_by = $request->insert_by;
		  $spl->insert_time = $request->insert_time;
		  $spl->update_by = $request->update_by;
		  $spl->update_time = $request->update_time;
		 if($spl->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$spl";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
		  $tgl = $request->tgl;
		  $nospl = $request->nospl;
		  $permintaan_dari = $request->permintaan_dari;
		  $jam = $request->jam;
		  $jam_mulai = $request->jam_mulai;
		  $jam_berakhir = $request->jam_berakhir;
		  $idkabag = $request->idkabag;
		  $tglacc_kabag = $request->tglacc_kabag;
		  $ket_kabag = $request->ket_kabag;
		  $idkadep = $request->idkadep;
		  $tglacc_kadep = $request->tglacc_kadep;
		  $ket_kadep = $request->ket_kadep;
		  $idmanager = $request->idmanager;
		  $tglacc_manager = $request->tglacc_manager;
		  $ket_manager = $request->ket_manager;
		  $acc = $request->acc;
		  $ket = $request->ket;
		  $acc_by = $request->acc_by;
		  $acc_time = $request->acc_time;
		  $insert_by = $request->insert_by;
		  $insert_time = $request->insert_time;
		  $update_by = $request->update_by;
		  $update_time = $request->update_time;
			 
			
			$spl = \App\mspl::where('idspl',$id) ->update([

				  'tgl' => $tgl,
				  'nospl' => $nospl,
				  'permintaan_dari' => $permintaan_dari,
				  'jam' => $jam,
				  'jam_mulai' => $jam_mulai,
				  'jam_berakhir' => $jam_berakhir,
				  'idkabag' => $idkabag,
				  'tglacc_kabag' => $tglacc_kabag,
				  'ket_kabag' => $ket_kabag,
				  'idkadep' => $idkadep,
				  'tglacc_kadep' => $tglacc_kadep,
				  'ket_kadep' => $ket_kadep,
				  'idmanager' => $idmanager,
				  'tglacc_manager' => $tglacc_manager,
				  'ket_manager' => $ket_manager,
				  'acc' => $acc,
				  'ket' => $ket,
				  'acc_by' => $acc,
				  'acc_time' => $ket,
				  'insert_by' => $insert_by,
				  'insert_time' => $insert_time,
				  'update_by' => $update_by,
				  'update_time' => $update_time,
			 ]);		 

			 
			$success=$spl;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$spl";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mspl::where('idspl',$id)->get();
		
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
			$data = \App\mspl::where('idspl',$id)->first();
		
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
		
		public function cmbspl(Request $request)
		{	
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$data = DB::select("select idpersplan,nama_persplan from tpersplan");
			if($data){ //mengecek apakah data kosong atau tidak
				
				$data = $this->paginate($data,$perPage);
				$data->appends($request->all());
				return response($data);
			}
		
		}
		public function popup_karyawan(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$data = DB::select("select idkaryawan,nik,nama from tkaryawan");
			if($data){ //mengecek apakah data kosong atau tidak
				
				$data = $this->paginate($data,$perPage);
				$data->appends($request->all());
				return response($data);
			}
		}
}
