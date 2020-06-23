<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\mijin;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class cijin extends Controller
{
	  public function index(Request $request)
		{
			$search = $request->search; 
			$perpage = $request->perpage;
			$page = $request->page;
		
			$tableIds = DB::select("SELECT a.idijin,a.idperijinan,a.tgl,b.nama AS karyawan,a.tgl_keluar,a.jam_keluar,a.tgl_kembali,a.jam_kembali,a.ket,c.nama_perijinan
FROM tijin AS a LEFT JOIN tkaryawan AS b ON a.`idkaryawan` = b.idkaryawan left join tperijinan as c ON a.idperijinan = c.idperijinan");

		$jsonResult = array();
        for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idijin"] = $tableIds[$i]->idijin;
			$jsonResult[$i]["idperijinan"] = $tableIds[$i]->idperijinan;
			$jsonResult[$i]["tgl"] = $tableIds[$i]->tgl;
			$jsonResult[$i]["karyawan"] = $tableIds[$i]->karyawan;
			$jsonResult[$i]["tgl_keluar"] = $tableIds[$i]->tgl_keluar;
			$jsonResult[$i]["jam_keluar"] = $tableIds[$i]->jam_keluar;
			$jsonResult[$i]["tgl_kembali"] = $tableIds[$i]->tgl_kembali;
			$jsonResult[$i]["jam_kembali"] = $tableIds[$i]->jam_kembali;
			$jsonResult[$i]["ket"] = $tableIds[$i]->ket;
			$jsonResult[$i]["nama_perijinan"] = $tableIds[$i]->nama_perijinan;
        }

		 if($jsonResult){ //mengecek apakah data kosong atau tidak
				
				$res = $this->paginate($jsonResult,$page,$perpage);
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
		
		public function paginate($items,$page,$perPage,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($page* $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
		
		
		
		public function store(Request $request){
		  $ijin = new \App\mijin();
		  $ijin->tgl = $request->tgl;
		  $ijin->idkaryawan = $request->idkaryawan;
		  $ijin->tgl_keluar = $request->tgl_keluar;
		  $ijin->jam_keluar = $request->jam_keluar;
		  $ijin->tgl_kembali = $request->tgl_kembali;
		  $ijin->jam_kembali = $request->jam_kembali;
		  $ijin->ket = $request->ket;
		  $ijin->idkaru = $request->idkaru;
		  $ijin->tglacc_karu = $request->tglacc_karu;
		  $ijin->ket_karu = $request->ket_karu;
		  $ijin->idkaur = $request->idkaur;
		  $ijin->tglacc_kaur = $request->tglacc_kaur;
		  $ijin->ket_kaur = $request->ket_kaur;
		  $ijin->idkabag = $request->idkabag;
		  $ijin->tglacc_kabag = $request->tglacc_kabag;
		  $ijin->ket_kabag = $request->ket_kabag;
		  $ijin->idkadep = $request->idkadep;
		  $ijin->tglacc_kadep = $request->tglacc_kadep;
		  $ijin->ket_kadep = $request->ket_kadep;
		  $ijin->imgbukti1 = $request->imgbukti1;
		  $ijin->imgbukti2 = $request->imgbukti2;
		  $ijin->flag = $request->flag;
		  $ijin->insert_by = $request->insert_by;
		  $ijin->insert_time = $request->insert_time;
		  $ijin->update_by = $request->update_by;
		  $ijin->update_time = $request->update_time;
		 if($ijin->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$ijin";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{

		  $tgl = $request->tgl;
		  $idkaryawan = $request->idkaryawan;
		  $tgl_keluar = $request->tgl_keluar;
		  $jam_keluar = $request->jam_keluar;
		  $tgl_kembali = $request->tgl_kembali;
		  $jam_kembali = $request->jam_kembali;
		  $ket = $request->ket;
		  $idkaru = $request->idkaru;
		  $tglacc_karu = $request->tglacc_karu;
		  $ket_karu = $request->ket_karu;
		  $idkaur = $request->idkaur;
		  $tglacc_kaur = $request->tglacc_kaur;
		  $ket_kaur = $request->ket_kaur;
		  $idkabag = $request->idkabag;
		  $tglacc_kabag = $request->tglacc_kabag;
		  $ket_kabag = $request->ket_kabag;
		  $idkadep = $request->idkadep;
		  $tglacc_kadep = $request->tglacc_kadep;
		  $ket_kadep = $request->ket_kadep;
		  $imgbukti1 = $request->imgbukti1;
		  $imgbukti2 = $request->imgbukti2;
		  $flag = $request->flag;
		  $insert_by = $request->insert_by;
		  $insert_time = $request->insert_time;
		  $update_by = $request->update_by;
		  $update_time = $request->update_time;
			 
			
			$ijin = \App\mijin::where('idijin',$id) ->update([

				 'tgl' => $tgl,
				  'idkaryawan' => $idkaryawan,
				  'tgl_keluar' => $tgl_keluar,
				  'jam_keluar' => $jam_keluar,
				  'tgl_kembali' => $tgl_kembali,
				  'jam_kembali' => $jam_kembali,
				  'ket' => $ket,
				  'idkaru' => $idkaru,
				  'tglacc_karu' => $tglacc_karu,
				  'ket_karu' => $ket_karu,
				  'idkaur' => $idkaur,
				  'tglacc_kaur' => $tglacc_kaur,
				  'ket_kaur' => $ket_kaur,
				  'idkabag' => $idkabag,
				  'tglacc_kabag' => $tglacc_kabag,
				  'ket_kabag' => $ket_kabag,
				  'idkadep' => $idkadep,
				  'tglacc_kadep' => $tglacc_kadep,
				  'ket_kadep' => $ket_kadep,
				  'imgbukti1' => $imgbukti1,
				  'imgbukti2' => $imgbukti2,
				  'flag' => $flag,
				  'insert_by' => $insert_by,
				  'insert_time' => $insert_time,
				  'update_by' => $update_by,
				  'update_time' => $update_time,
			 ]);		 

			 
			$success=$ijin;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$ijin";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mijin::where('idijin',$id)->get();
		
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
			$data = \App\mijin::where('idijin',$id)->first();
		
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
		
		public function cmbijin(Request $request)
		{
			$search = $request->search; 
			$perpage = $request->perpage;
			$page = $request->page;
			$data = DB::select("select idperijinan,nama_perijinan from tperijinan");
		    $data = $this->paginate($data,$page,$perpage);
		    $data->appends($request->all());
			return response($data);
		}
		public function popup_karyawan(Request $request)
		{
			$search = $request->search; 
			$perpage = $request->perpage;
			$page = $request->page;
			$data = DB::select("select idkaryawan,nik,nama from tkaryawan");
			$data = $this->paginate($data,$page,$perpage);
		    $data->appends($request->all());
			return response($data);
		}
}
