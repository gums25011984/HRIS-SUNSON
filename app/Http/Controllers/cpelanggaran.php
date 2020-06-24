<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\mpelanggaran;
class cpelanggaran extends Controller
{
	  public function index(Request $request)
		{
		$search = $request->search; 
			$perPage = $request->perpage;
			$page = $request->page;
			
			$tableIds = DB::select("SELECT a.idpelanggaran,a.tgl,b.nama AS karyawan,c.nama AS saksi,d.nama AS 
		pelapor,e.master_pelanggaran AS pelanggaran,a.ket,CONCAT_WS('  -  ',a.tglmulai_sangsi, a.tglberakhir_sangsi) as berlaku, IF (a.status IS NULL OR status = '' OR status = '0','Aktif','Tidak Aktif') as status, f.sangsi
		FROM tpelanggaran AS a LEFT JOIN tkaryawan AS b ON a.idkaryawan = b.idkaryawan LEFT JOIN tkaryawan AS c ON a.saksi = 					
		c.idkaryawan LEFT JOIN tkaryawan AS d ON d.idkaryawan = a.pelapor 
		LEFT JOIN tmaster_pelanggaran AS e ON a.idmaster_pelanggaran = e.idmaster_pelanggaran left join tsangsi as f On a.idsangsi = f.idsangsi");

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
		  $pelanggaran = new \App\mpelanggaran();
		  $pelanggaran->tgl = $request->tgl;
		  $pelanggaran->idkaryawan = $request->idkaryawan;
		  $pelanggaran->pelapor = $request->pelapor;
		  $pelanggaran->saksi = $request->saksi;
		  $pelanggaran->tglmulai_sangsi = $request->tglmulai_sangsi;
		  $pelanggaran->tglberakhir_sangsi = $request->tglberakhir_sangsi;
		  $pelanggaran->idmaster_pelanggaran = $request->idmaster_pelanggaran;
		  $pelanggaran->idsangsi = $request->idsangsi;
		  $pelanggaran->ket = $request->ket;
		  $pelanggaran->imgbukti1 = $request->imgbukti1;
		  $pelanggaran->imgbukti2 = $request->imgbukti2;
		  $pelanggaran->insert_by = $request->insert_by;
		  $pelanggaran->insert_time = $request->insert_time;
		  $pelanggaran->update_by = $request->update_by;
		  $pelanggaran->update_time = $request->update_time;
		 if($pelanggaran->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$pelanggaran";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{

		  $tgl = $request->tgl;
		  $idkaryawan = $request->idkaryawan;
		  $pelapor = $request->pelapor;
		  $saksi = $request->saksi;
		  $tglmulai_sangsi = $request->tglmulai_sangsi;
		  $tglberakhir_sangsi = $request->tglberakhir_sangsi;
		  $idmaster_pelanggaran = $request->idmaster_pelanggaran;
		  $idsangsi = $request->idsangsi;
		  $ket = $request->ket;
		  $imgbukti1 = $request->imgbukti1;
		  $imgbukti2 = $request->imgbukti2;
			 
			
			$pelanggaran = \App\mpelanggaran::where('idpelanggaran',$id) ->update([

				 
				  'tgl' => $tgl,
				  'idkaryawan' => $idkaryawan,
				  'pelapor' => $pelapor,
				  'saksi' => $saksi,
				  'tglmulai_sangsi' => $tglmulai_sangsi,
				  'tglberakhir_sangsi' => $tglberakhir_sangsi,
				  'idmaster_pelanggaran' => $idmaster_pelanggaran,
				  'idsangsi' => $idsangsi,
				  'ket' => $ket,
				  'imgbukti1' => $imgbukti1,
				  'imgbukti2' => $imgbukti2,
			 ]);		 

			 
			$success=$pelanggaran;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$pelanggaran";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mpelanggaran::where('idpelanggaran',$id)->get();
		
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
			$data = \App\mpelanggaran::where('idpelanggaran',$id)->first();
		
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
		
		public function cmbpelanggaran(Request $request)
		{
			$search = $request->search; 
			$perPage = $request->perpage;
			$page = $request->page;
			
			$data = DB::select("select idmaster_pelanggaran,master_pelanggaran from tmaster_pelanggaran");
			$data = $this->paginate($data,$perPage);
			
		    $data->appends($request->all());
			return response($data);
		}
		public function popup_karyawan(Request $request)
		{
			$search = $request->search; 
			$perPage = $request->perpage;
			$page = $request->page;
			$data = DB::select("select idkaryawan,nik,nama from tkaryawan");
			$data = $this->paginate($data,$perPage);
		    $data->appends($request->all());
			return response($data);
		}
}
