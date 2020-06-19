<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mkaryawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class Ckaryawan extends Controller
{
		public function index(Request $request)
		{
		$search = $request->search; 
		$page = $request->page; 
		$sort = $request->sort;
	/*	$tableIds = DB::select( DB::raw("SELECT idjabatan,jabatan,'' as karyawan FROM tjabatan"));*/
		$tableIds = DB::select( DB::raw("SELECT a.idkaryawan,a.pin,a.nik,a.noktp,a.nama,a.nobpjs,a.tempat_lahir,a.agama,a.jk,
				CONCAT_WS(' ',a.alamat, e.name ,f.name,g.name ,h.name) as alt,a.tlp,j.divisi,
				a.hp,b.pendidikan,c.jabatan,d.departemen,i.mgroup_kerja,a.jobdesk,a.tanggal_masuk,a.tanggal_keluar,
				a.`tanggal_diangkat`
				FROM tkaryawan AS a LEFT JOIN tpendidikan AS b ON a.idpendidikan = b.`idpendidikan`
				LEFT JOIN tjabatan AS c ON a.`idjabatan` = c.`idjabatan`
				LEFT JOIN tdepartemen AS d ON a.`iddepartemen` = d.`iddepartemen` left join villages as e ON a.iddesa = e.id
				left join districts as f on a.idkecamatan = f.id
				left join regencies as g on a.idkota = g.id
				left join provinces as h on a.idpropinsi = h.id
				left join tmgroup_kerja as i on a.idgroup = i.idmgroup_kerja
				left join tdivisi as j on a.iddivisi = j.iddivisi where a.nama like '" . $search . "%' or a.nik like '" . $search . "%' or a.jk like '" . $search . "%'  or c.jabatan like '" . $search . "%' or d.departemen like '" . $search . "%'  or i.mgroup_kerja like '" . $search . "%' or a.hp like '" . $search . "%'  "));
				
        $jsonResult = array();

        for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idkaryawan"] = $tableIds[$i]->idkaryawan;
			$jsonResult[$i]["pin"] = $tableIds[$i]->pin;
			$jsonResult[$i]["nik"] = $tableIds[$i]->nik;
			$jsonResult[$i]["noktp"] = $tableIds[$i]->noktp;
			$jsonResult[$i]["nobpjs"] = $tableIds[$i]->nobpjs;
			$jsonResult[$i]["nama"] = $tableIds[$i]->nama;
			$jsonResult[$i]["tempat_lahir"] = $tableIds[$i]->tempat_lahir;
			$jsonResult[$i]["agama"] = $tableIds[$i]->agama;
			$jsonResult[$i]["jk"] = $tableIds[$i]->jk;
			$jsonResult[$i]["alamat"] = $tableIds[$i]->alt;
			$jsonResult[$i]["tlp"] = $tableIds[$i]->tlp;
			$jsonResult[$i]["divisi"] = $tableIds[$i]->divisi;
			$jsonResult[$i]["hp"] = $tableIds[$i]->hp;
			$jsonResult[$i]["pendidikan"] = $tableIds[$i]->pendidikan;
			$jsonResult[$i]["jabatan"] = $tableIds[$i]->jabatan;
			$jsonResult[$i]["departemen"] = $tableIds[$i]->departemen;
			$jsonResult[$i]["mgroup_kerja"] = $tableIds[$i]->mgroup_kerja;
			$jsonResult[$i]["jobdesk"] = $tableIds[$i]->jobdesk;
			$jsonResult[$i]["tanggal_masuk"] = $tableIds[$i]->tanggal_masuk;
			$jsonResult[$i]["tanggal_keluar"] = $tableIds[$i]->tanggal_keluar;
			$jsonResult[$i]["tanggal_diangkat"] = $tableIds[$i]->tanggal_diangkat;
            
        }

		 if($jsonResult > 0){ //mengecek apakah data kosong atau tidak
				$res['message'] = "Success!";
				$res['values'] = $jsonResult;
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
		 $karyawan = new \App\mkaryawan();
		  $karyawan->pin = $request->pin; 
		  $karyawan->nik = $request->nik;
		  $karyawan->nobpjs = $request->nobpjs;
		  $karyawan->bpjstk = $request->bpjstk;
		  $karyawan->nama = $request->nama;
		  $karyawan->tempat_lahir = $request->tempat_lahir;
		  $karyawan->tanggal_lahir = $request->tanggal_lahir;
		  $karyawan->noktp = $request->noktp;
		  $karyawan->agama = $request->agama;
		  $karyawan->jk = $request->jk;
		  $karyawan->photo = $request->photo;
		  $karyawan->idgroup = $request->idgroup;
		  $karyawan->idstatus_pernikahan = $request->idstatus_pernikahan;
		  $karyawan->jml_anak = $request->jml_anak;
		  $karyawan->alamat = $request->alamat;
		  $karyawan->alamat_sekarang = $request->alamat_sekarang;
		  $karyawan->kode_pos = $request->kode_pos;
		  $karyawan->idpropinsi = $request->idpropinsi;
		  $karyawan->idkota = $request->idkota;
		  $karyawan->idkecamatan = $request->idkecamatan;
		  $karyawan->iddesa = $request->iddesa;
		  $karyawan->negara = $request->negara;
		  $karyawan->tlp = $request->tlp;
		  $karyawan->hp = $request->hp;
		  $karyawan->idpendidikan = $request->idpendidikan; 
		  $karyawan->idjabatan = $request->idjabatan; 
		  $karyawan->idstatus_kerja = $request->idstatus_kerja; 
		  $karyawan->idcabang = $request->idcabang;
		  $karyawan->iddepartemen = $request->iddepartemen;
		  $karyawan->iddivisi = $request->iddivisi;
		  $karyawan->idgaji = $request->idgaji; 
		  $karyawan->tanggal_diangkat = $request->tanggal_diangkat; 
		  $karyawan->tanggal_masuk = $request->tanggal_masuk; 
		  $karyawan->tglhabis_kontrak = $request->tglhabis_kontrak;
		  $karyawan->tanggal_keluar = $request->tanggal_keluar;
		  $karyawan->jobdesk = $request->jobdesk;
		  $karyawan->jmlcuti = $request->jmlcuti;
		  $karyawan->idtransportlembur = $request->idtransportlembur;
		  $karyawan->suami_istri = $request->suami_istri;
		  $karyawan->tempat_lahir0 = $request->tempat_lahir0;
		  $karyawan->tanggal_lahir0 = $request->tanggal_lahir0;
		  $karyawan->alamat0 = $request->alamat0;
		  $karyawan->ket0 = $request->ket0; 
		  $karyawan->tlp0 = $request->tlp0;
		  $karyawan->anak1 = $request->anak1;
		  $karyawan->tempat_lahir1 = $request->tempat_lahir1; 
		  $karyawan->tanggal_lahir1 = $request->tanggal_lahir1;
		  $karyawan->alamat1 = $request->alamat1; 
		  $karyawan->ket1 = $request->ket1; 
		  $karyawan->tlp1 = $request->tlp1; 
		  $karyawan->anak2 = $request->anak2;
		  $karyawan->tempat_lahir2 = $request->tempat_lahir2;
		  $karyawan->tanggal_lahir2 = $request->tanggal_lahir2;
		  $karyawan->alamat2 = $request->alamat2;
		  $karyawan->ket2 = $request->ket2;
		  $karyawan->tlp2 = $request->tlp2;
		  $karyawan->anak3 = $request->anak3;
		  $karyawan->tempat_lahir3 = $request->tempat_lahir3;
		  $karyawan->tanggal_lahir3 = $request->tanggal_lahir3;
		  $karyawan->alamat3 = $request->alamat3;
		  $karyawan->ket3 = $request->ket3;
		  $karyawan->tlp3 = $request->tlp3;
		  $karyawan->anak4 = $request->anak4;
		  $karyawan->tempat_lahir4 = $request->tempat_lahir4;
		  $karyawan->tanggal_lahir4 = $request->tanggal_lahir4;
		  $karyawan->alamat4 = $request->alamat4;
		  $karyawan->ket4 = $request->ket4;
		  $karyawan->tlp4 = $request->tlp4;
		  $karyawan->ayah = $request->ayah;
		  $karyawan->tempat_lahir_ayah = $request->tempat_lahir_ayah;
		  $karyawan->tanggal_lahir_ayah = $request->tanggal_lahir_ayah;
		  $karyawan->alamat_ayah = $request->alamat_ayah;
		  $karyawan->ket_ayah = $request->ket_ayah;
		  $karyawan->tlpayah = $request->tlpayah;
		  $karyawan->ibu = $request->ibu;
		  $karyawan->tempat_lahir_ibu = $request->tempat_lahir_ibu;
		  $karyawan->tanggal_lahir_ibu = $request->tanggal_lahir_ibu; 
		  $karyawan->alamat_ibu = $request->alamat_ibu;
		  $karyawan->ket_ibu = $request->ket_ibu;
		  $karyawan->tlpibu = $request->tlpibu;
		  $karyawan->idalat_kontrasepsi = $request->idalat_kontrasepsi;
		  $karyawan->PASSWORD = $request->PASSWORD;
		  $karyawan->insert_by = $request->insert_by;
		  $karyawan->insert_time = $request->insert_time;
		  $karyawan->update_by = $request->update_by;
		  $karyawan->update_time = $request->update_time;
		 if($karyawan->save()){ 
				$res['message'] = "Success!";
				$res['value'] = "$karyawan";
				return response($res);
			}
		}
		
		
		public function update(Request $request, $id)
		{
			//
			 
		  $pin = $request->pin; 
		  $nik = $request->nik;
		  $nobpjs = $request->nobpjs;
		  $bpjstk = $request->bpjstk;
		  $nama = $request->nama;
		  $tempat_lahir = $request->tempat_lahir;
		  $tanggal_lahir = $request->tanggal_lahir;
		  $noktp = $request->noktp;
		  $agama = $request->agama;
		  $jk = $request->jk;
		  $photo = $request->photo;
		  $idgroup = $request->idgroup;
		  $idstatus_pernikahan = $request->idstatus_pernikahan;
		  $jml_anak = $request->jml_anak;
		  $alamat = $request->alamat;
		  $alamat_sekarang = $request->alamat_sekarang;
		  $kode_pos = $request->kode_pos;
		  $idpropinsi = $request->idpropinsi;
		  $idkota = $request->idkota;
		  $idkecamatan = $request->idkecamatan;
		  $iddesa = $request->iddesa;
		  $negara = $request->negara;
		  $tlp = $request->tlp;
		  $hp = $request->hp;
		  $idpendidikan = $request->idpendidikan; 
		  $idjabatan = $request->idjabatan; 
		  $idstatus_kerja = $request->idstatus_kerja; 
		  $idcabang = $request->idcabang;
		  $iddepartemen = $request->iddepartemen;
		  $iddivisi = $request->iddivisi;
		  $idgaji = $request->idgaji; 
		  $tanggal_diangkat = $request->tanggal_diangkat; 
		  $tanggal_masuk = $request->tanggal_masuk; 
		  $tglhabis_kontrak = $request->tglhabis_kontrak;
		  $tanggal_keluar = $request->tanggal_keluar;
		  $jobdesk = $request->jobdesk;
		  $jmlcuti = $request->jmlcuti;
		  $idtransportlembur = $request->idtransportlembur;
		  $suami_istri = $request->suami_istri;
		  $tempat_lahir0 = $request->tempat_lahir0;
		  $tanggal_lahir0 = $request->tanggal_lahir0;
		  $alamat0 = $request->alamat0;
		  $ket0 = $request->ket0; 
		  $tlp0 = $request->tlp0;
		  $anak1 = $request->anak1;
		  $tempat_lahir1 = $request->tempat_lahir1; 
		  $tanggal_lahir1 = $request->tanggal_lahir1;
		  $alamat1 = $request->alamat1; 
		  $ket1 = $request->ket1; 
		  $tlp1 = $request->tlp1; 
		  $anak2 = $request->anak2;
		  $tempat_lahir2 = $request->tempat_lahir2;
		  $tanggal_lahir2 = $request->tanggal_lahir2;
		  $alamat2 = $request->alamat2;
		  $ket2 = $request->ket2;
		  $tlp2 = $request->tlp2;
		  $anak3 = $request->anak3;
		  $tempat_lahir3 = $request->tempat_lahir3;
		  $tanggal_lahir3 = $request->tanggal_lahir3;
		  $alamat3 = $request->alamat3;
		  $ket3 = $request->ket3;
		  $tlp3 = $request->tlp3;
		  $anak4 = $request->anak4;
		  $tempat_lahir4 = $request->tempat_lahir4;
		  $tanggal_lahir4 = $request->tanggal_lahir4;
		  $alamat4 = $request->alamat4;
		  $ket4 = $request->ket4;
		  $tlp4 = $request->tlp4;
		  $ayah = $request->ayah;
		  $tempat_lahir_ayah = $request->tempat_lahir_ayah;
		  $tanggal_lahir_ayah = $request->tanggal_lahir_ayah;
		  $alamat_ayah = $request->alamat_ayah;
		  $ket_ayah = $request->ket_ayah;
		  $tlpayah = $request->tlpayah;
		  $ibu = $request->ibu;
		  $tempat_lahir_ibu = $request->tempat_lahir_ibu;
		  $tanggal_lahir_ibu = $request->tanggal_lahir_ibu; 
		  $alamat_ibu = $request->alamat_ibu;
		  $ket_ibu = $request->ket_ibu;
		  $tlpibu = $request->tlpibu;
		  $idalat_kontrasepsi = $request->idalat_kontrasepsi;
		  $PASSWORD = $request->PASSWORD;
		  $insert_by = $request->insert_by;
		  $insert_time = $request->insert_time;
		  $update_by = $request->update_by;
		  $update_time = $request->update_time;
			 
			
			$karyawan = \App\mkaryawan::where('idkaryawan',$id) ->update([
				 
				  'pin' => $pin, 
				  'nik' =>  $nik,
				  'nobpjs' =>  $nobpjs,
				  'bpjstk' =>  $bpjstk,
				  'nama' =>  $nama,
				  'tempat_lahir' =>  $tempat_lahir,
				  'tanggal_lahir' =>  $tanggal_lahir,
				  'noktp' =>  $noktp,
				  'agama' =>  $agama,
				  'jk' =>  $jk,
				  'photo' =>  $photo,
				  'idgroup' =>  $idgroup,
				  'idstatus_pernikahan' =>  $idstatus_pernikahan,
				  'jml_anak' =>  $jml_anak,
				  'alamat' =>  $alamat,
				  'alamat_sekarang' =>  $alamat_sekarang,
				  'kode_pos' =>  $kode_pos,
				  'idpropinsi' =>  $idpropinsi,
				  'idkota' =>  $idkota,
				  'idkecamatan' =>  $idkecamatan,
				  'iddesa' =>  $iddesa,
				  'negara' =>  $negara,
				  'tlp' =>  $tlp,
				  'hp' =>  $hp,
				  'idpendidikan' =>  $idpendidikan, 
				  'idjabatan' =>  $idjabatan, 
				  'idstatus_kerja' =>  $idstatus_kerja, 
				  'idcabang' =>  $idcabang,
				  'iddepartemen' =>  $iddepartemen,
				  'iddivisi' =>  $iddivisi,
				  'idgaji' =>  $idgaji, 
				  'tanggal_diangkat' =>  $tanggal_diangkat, 
				  'tanggal_masuk' =>  $tanggal_masuk, 
				  'tglhabis_kontrak' =>  $tglhabis_kontrak,
				  'tanggal_keluar' =>  $tanggal_keluar,
				  'jobdesk' =>  $jobdesk,
				  'jmlcuti' =>  $jmlcuti,
				  'idtransportlembur' =>  $idtransportlembur,
				  'suami_istri' =>  $suami_istri,
				  'tempat_lahir0' =>  $tempat_lahir0,
				  'tanggal_lahir0' =>  $tanggal_lahir0,
				  'alamat0' =>  $alamat0,
				  'ket0' =>  $ket0, 
				  'tlp0' =>  $tlp0,
				  'anak1' =>  $anak1,
				  'tempat_lahir1' =>  $tempat_lahir1, 
				  'tanggal_lahir1' =>  $tanggal_lahir1,
				  'alamat1' =>  $alamat1, 
				  'ket1' =>  $ket1, 
				  'tlp1' =>  $tlp1, 
				  'anak2' =>  $anak2,
				  'tempat_lahir2' =>  $tempat_lahir2,
				  'tanggal_lahir2' =>  $tanggal_lahir2,
				  'alamat2' =>  $alamat2,
				  'ket2' =>  $ket2,
				  'tlp2' =>  $tlp2,
				  'anak3' =>  $anak3,
				  'tempat_lahir3' =>  $tempat_lahir3,
				  'tanggal_lahir3' =>  $tanggal_lahir3,
				  'alamat3' =>  $alamat3,
				  'ket3' =>  $ket3,
				  'tlp3' =>  $tlp3,
				  'anak4' =>  $anak4,
				  'tempat_lahir4' =>  $tempat_lahir4,
				  'tanggal_lahir4' =>  $tanggal_lahir4,
				  'alamat4' =>  $alamat4,
				  'ket4' =>  $ket4,
				  'tlp4' =>  $tlp4,
				  'ayah' =>  $ayah,
				  'tempat_lahir_ayah' =>  $tempat_lahir_ayah,
				  'tanggal_lahir_ayah' =>  $tanggal_lahir_ayah,
				  'alamat_ayah' =>  $alamat_ayah,
				  'ket_ayah' =>  $ket_ayah,
				  'tlpayah' =>  $tlpayah,
				  'ibu' =>  $ibu,
				  'tempat_lahir_ibu' =>  $tempat_lahir_ibu,
				  'tanggal_lahir_ibu' =>  $tanggal_lahir_ibu, 
				  'alamat_ibu' =>  $alamat_ibu,
				  'ket_ibu' =>  $ket_ibu,
				  'tlpibu' =>  $tlpibu,
				  'idalat_kontrasepsi' =>  $idalat_kontrasepsi,
				  'PASSWORD' =>  $PASSWORD,
				  'insert_by' =>  $insert_by,
				  'insert_time' =>  $insert_time,
				  'update_by' =>  $update_by,
				  'update_time' =>  $update_time,
			 ]);		 

			 
			$success=$karyawan;
			if($success){
				$res['message'] = "Success!";
				$res['value'] = "$karyawan";
				return response($res);
			}
			else{
				$res['message'] = "Failed!";
				return response($res);
			}
		}
		public function show($id)
		{
			$data = \App\mkaryawan::where('idkaryawan',$id)->get();
		
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
			$data = \App\mkaryawan::where('idkaryawan',$id)->first();
		
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
		
		public function propinsi()
		{
			$data = DB::select("select id,name from provinces");
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
		public function kabupaten()
		{
			$data = DB::select("select id,name from regencies limit 10");
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
		public function kecamatan()
		{
			$data = DB::select("select id,name from districts limit 10");
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
		public function desa()
		{
			$data = DB::select("select id,name from villages limit 10");
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
		public function status_pernikahan()
		{
			$data = DB::select("select idstatus_pernikahan,status_pernikahan from tstatus_pernikahan");
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
		public function alat_kontrasepsi()
		{
			$data = DB::select("select idalat_kontrasepsi,alat_kontrasepsi from talat_kontrasepsi");
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
		public function jabatan()
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
		public function pendidikan()
		{
			$data = DB::select("select idpendidikan,pendidikan from tpendidikan");
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
		public function divisi()
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
		public function departemen()
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
		public function status_kerja()
		{
			$data = DB::select("select idstatus_kerja,status_kerja from tstatus_kerja");
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
		public function mgroup_kerja()
		{
			$data = DB::select("select idmgroup_kerja,mgroup_kerja from tmgroup_kerja");
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
		public function transportlembur()
		{
			$data = DB::select("select idtransportlembur,jurusan from ttransportlembur");
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
