<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\mmutasi;
class cmutasi extends Controller
{
	  public function index(Request $request)
		{
			$srch = $request->srch; 
			$per_page = $request->per_page;
			
			$tableIds = DB::select("SELECT a.idkaryawan,a.idmutasi,a.tgl,b.nik,b.nama ,c.departemen AS dept_awal,d.divisi AS 
div_awal,e.jabatan AS jab_awal,f.departemen AS dept,g.divisi AS divisi,h.jabatan AS jabatan, a.ket,
a.nmkadep,a.`tglacckadep`,a.`nmhrd`,a.`tglacchrd`,a.`nmdirektur`,a.`tglaccdirektur`,
a.`iddepartemen_baru`,a.`iddivisi_baru`,a.`idjabatan_baru`,
a.`iddepartemen_asal`,a.`iddivisi_asal`,a.`idjabatan_asal`
FROM tmutasi AS a LEFT JOIN tkaryawan AS b ON a.idkaryawan = b.idkaryawan 
LEFT JOIN tdepartemen AS c ON a.iddepartemen_asal = c.iddepartemen 
LEFT JOIN tdivisi AS d ON a.iddivisi_asal = d.iddivisi 
LEFT JOIN tjabatan AS e ON a.idjabatan_asal = b.idjabatan
LEFT JOIN tdepartemen AS f ON a.`iddepartemen_baru` = f.`iddepartemen`
LEFT JOIN tdivisi AS g ON a.`iddivisi_baru` = g.`iddivisi`
LEFT JOIN tjabatan AS h ON a.`idjabatan_baru` = h.idjabatan");

		$jsonResult = array();
		
		for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idkaryawan"] = $tableIds[$i]->idkaryawan;
			$jsonResult[$i]["idmutasi"] = $tableIds[$i]->idmutasi;
			$jsonResult[$i]["tgl"] = $tableIds[$i]->tgl;
			$jsonResult[$i]["nik"] = $tableIds[$i]->nik;
			$jsonResult[$i]["nama"] = $tableIds[$i]->nama;
			$jsonResult[$i]["dept_awal"] = $tableIds[$i]->dept_awal;
			$jsonResult[$i]["div_awal"] = $tableIds[$i]->div_awal;
			$jsonResult[$i]["jab_awal"] = $tableIds[$i]->jab_awal;
			$jsonResult[$i]["dept"] = $tableIds[$i]->dept;
			
			$jsonResult[$i]["divisi"] = $tableIds[$i]->divisi;
			$jsonResult[$i]["jabatan"] = $tableIds[$i]->jabatan;
			$jsonResult[$i]["ket"] = $tableIds[$i]->ket;
			$jsonResult[$i]["nmkadep"] = $tableIds[$i]->nmkadep;

			$jsonResult[$i]["tglacckadep"] = $tableIds[$i]->tglacckadep;
			$jsonResult[$i]["nmhrd"] = $tableIds[$i]->nmhrd;
			$jsonResult[$i]["tglacchrd"] = $tableIds[$i]->tglacchrd;
			$jsonResult[$i]["nmdirektur"] = $tableIds[$i]->nmdirektur;

			$jsonResult[$i]["tglaccdirektur"] = $tableIds[$i]->tglaccdirektur;
			$jsonResult[$i]["iddepartemen_baru"] = $tableIds[$i]->iddepartemen_baru;
			$jsonResult[$i]["iddivisi_baru"] = $tableIds[$i]->iddivisi_baru;
			$jsonResult[$i]["idjabatan_baru"] = $tableIds[$i]->idjabatan_baru;
			$jsonResult[$i]["iddepartemen_asal"] = $tableIds[$i]->iddepartemen_asal;
			$jsonResult[$i]["iddivisi_asal"] = $tableIds[$i]->iddivisi_asal;
			$jsonResult[$i]["idjabatan_asal"] = $tableIds[$i]->idjabatan_asal;

		 }
		 if($jsonResult > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $jsonResult;
				$res = $this->paginate($jsonResult,$per_page);
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		
		}
		
		public function paginate($items,$per_page,$pageStart=1)
		{
			$per_page = \Request::get('per_page') ?: 100;
			// Start displaying items from this number;
			$offSet = ($pageStart * $per_page) - $per_page; 
	
			// Get only the items you need using array_slice
			$itemsForCurrentPage = array_slice($items, $offSet, $per_page, true);
	
			return new LengthAwarePaginator($itemsForCurrentPage, count($items), $per_page,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
		}
		
		public function store(Request $request){
		  $mutasi = new \App\mmutasi();
		  $mutasi->tgl = $request->tgl;
		  $mutasi->idkaryawan = $request->idkaryawan;
		  $mutasi->iddepartemen_asal = $request->iddepartemen_asal;
		  $mutasi->iddivisi_asal = $request->iddivisi_asal;
		  $mutasi->idjabatan_asal = $request->idjabatan_asal;
		  $mutasi->iddepartemen_baru = $request->iddepartemen_baru;
		  $mutasi->iddivisi_baru = $request->iddivisi_baru;
		  $mutasi->idjabatan_baru = $request->idjabatan_baru;
		  $mutasi->ket = $request->ket;
		  $mutasi->idkadep = $request->idkadep;
		  $mutasi->nmkadep = $request->nmkadep;
		  $mutasi->tglacckadep = $request->tglacckadep;
		  $mutasi->ketkadep = $request->ketkadep;
		  $mutasi->idhrd = $request->idhrd;
		  $mutasi->nmhrd = $request->nmhrd;
		  $mutasi->tglacchrd = $request->tglacchrd;
		  $mutasi->kethrd = $request->kethrd;
		  $mutasi->iddirektur = $request->iddirektur;
		  $mutasi->nmdirektur = $request->nmdirektur;
		  $mutasi->tglaccdirektur = $request->tglaccdirektur;
		  $mutasi->ketdirektur = $request->ketdirektur;
		  $mutasi->acc = $request->acc;
		  $mutasi->insert_by = $request->insert_by;
		  $mutasi->insert_time = $request->insert_time;
		  $mutasi->update_by = $request->update_by;
		  $mutasi->update_time = $request->update_time;
		 if($mutasi->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$mutasi";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{

		  
		  $tgl = $request->tgl;
		  $idkaryawan = $request->idkaryawan;
		  $iddepartemen_asal = $request->iddepartemen_asal;
		  $iddivisi_asal = $request->iddivisi_asal;
		  $idjabatan_asal = $request->idjabatan_asal;
		  $iddepartemen_baru = $request->iddepartemen_baru;
		  $iddivisi_baru = $request->iddivisi_baru;
		  $idjabatan_baru = $request->idjabatan_baru;
		  $ket = $request->ket;
		  $idkadep = $request->idkadep;
		  $nmkadep = $request->nmkadep;
		  $tglacckadep = $request->tglacckadep;
		  $ketkadep = $request->ketkadep;
		  $idhrd = $request->idhrd;
		  $nmhrd = $request->nmhrd;
		  $tglacchrd = $request->tglacchrd;
		  $kethrd = $request->kethrd;
		  $iddirektur = $request->iddirektur;
		  $nmdirektur = $request->nmdirektur;
		  $tglaccdirektur = $request->tglaccdirektur;
		  $ketdirektur = $request->ketdirektur;
		  $acc = $request->acc;
		  $insert_by = $request->insert_by;
		  $insert_time = $request->insert_time;
		  $update_by = $request->update_by;
		  $update_time = $request->update_time;
			 
			
			$mutasi = \App\mmutasi::where('idmutasi',$id) ->update([

				 'tgl' => $tgl,
				  'idkaryawan' => $idkaryawan,
				  'iddepartemen_asal' => $iddepartemen_asal,
				  'iddivisi_asal' => $iddivisi_asal,
				  'idjabatan_asal' => $idjabatan_asal,
				  'iddepartemen_baru' => $iddepartemen_baru,
				  'iddivisi_baru' => $iddivisi_baru,
				  'idjabatan_baru' => $idjabatan_baru,
				  'ket' => $ket,
				  'idkadep' => $idkadep,
				  'nmkadep' => $nmkadep,
				  'tglacckadep' => $tglacckadep,
				  'ketkadep' => $ketkadep,
				  'idhrd' => $idhrd,
				  'nmhrd' => $nmhrd,
				  'tglacchrd' => $tglacchrd,
				  'kethrd' => $kethrd,
				  'iddirektur' => $iddirektur,
				  'nmdirektur' => $nmdirektur,
				  'tglaccdirektur' => $tglaccdirektur,
				  'ketdirektur' => $ketdirektur,
				  'acc' => $acc,
				  'insert_by' => $insert_by,
				  'insert_time' => $insert_time,
				  'update_by' => $update_by,
				  'update_time' => $update_time,
			 ]);		 

			 
			$success=$mutasi;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$mutasi";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mmutasi::where('idmutasi',$id)->get();
		
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
			$data = \App\mmutasi::where('idmutasi',$id)->first();
		
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
		
		
		public function departement_baru()
		{
			$data = DB::select("select iddepartemen,departemen from tdepartemen");
			if($data > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $data;
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
		public function divisi_baru()
		{
			$data = DB::select("select iddivisi,divisi from tdivisi");
			if($data > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $data;
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
		
		public function jabatan_baru()
		{
			$data = DB::select("select idjabatan,jabatan from tjabatan");
			if($data > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $data;
				return response($res);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}
}
