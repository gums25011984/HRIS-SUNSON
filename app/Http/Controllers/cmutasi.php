<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\mmutasi;
class cmutasi extends Controller
{
	  public function index()
		{
			$data = DB::select("SELECT a.idkaryawan,a.idmutasi,a.tgl,b.nik,b.nama ,c.departemen AS dept_awal,d.divisi AS 
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
