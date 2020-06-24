<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class cdashboard extends Controller
{
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$search = $request->search;
			$data = DB::select("SELECT  a.idspl,a.tgl,a.nospl,CONCAT(jam_mulai, ' ', jam_berakhir) AS jam,b.nama
										FROM tspl AS a LEFT JOIN tkaryawan AS b ON b.idkaryawan = a.permintaan_dari where a.acc is null or a.acc = '0'");
										
			$collect = collect($data);
			return $paginationData = new LengthAwarePaginator(
                         $collect->forPage($page, $perPage),
                         $collect->count(), 
                         $page, 
                         $perPage,
						[
							'path' => LengthAwarePaginator::resolveCurrentPath(),
							'pageName' => 'page',
						]
                       );
			
		}
		public function approved(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$data = DB::select("SELECT  a.idspl,a.tgl,a.nospl,CONCAT(jam_mulai, ' ', jam_berakhir) AS jam,b.nama
										FROM tspl AS a LEFT JOIN tkaryawan AS b ON b.idkaryawan = a.permintaan_dari where a.acc ='1'");

			$collect = collect($data);
			return $paginationData = new LengthAwarePaginator(
                         $collect->forPage($page, $perPage),
                         $collect->count(), 
                         $page, 
                         $perPage,
						[
							'path' => LengthAwarePaginator::resolveCurrentPath(),
							'pageName' => 'page',
						]
                       );
		}
		
		public function reject()
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			$data = DB::select("SELECT  a.idspl,a.tgl,a.nospl,CONCAT(jam_mulai, ' ', jam_berakhir) AS jam,b.nama
										FROM tspl AS a LEFT JOIN tkaryawan AS b ON b.idkaryawan = a.permintaan_dari where a.acc ='2' ");
			
			$collect = collect($data);
			return $paginationData = new LengthAwarePaginator(
                         $collect->forPage($page, $perPage),
                         $collect->count(), 
                         $page, 
                         $perPage,
						[
							'path' => LengthAwarePaginator::resolveCurrentPath(),
							'pageName' => 'page',
						]
                       );
		}
		
		public function kesiangan()
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			
			$data = DB::select("SELECT DISTINCT a.tgl_masuk,a.nik,b.nama,c.departemen,a.jam_masuk,
			FORMAT(TIME_TO_SEC(TIMEDIFF(jam_masuk,jam_wajib_masuk))/(60*60),2) as selisih_jam FROM tabsen AS a LEFT JOIN tkaryawan AS b ON a.nik = b.nik LEFT JOIN tdepartemen AS c ON b.iddepartemen = c.iddepartemen where jam_masuk > jam_wajib_masuk and a.tgl_masuk = CURRENT_DATE()");
			
			$collect = collect($data);
			return $paginationData = new LengthAwarePaginator(
                         $collect->forPage($page, $perPage),
                         $collect->count(), 
                         $page, 
                         $perPage,
						[
							'path' => LengthAwarePaginator::resolveCurrentPath(),
							'pageName' => 'page',
						]
                       );
		}
		public function mangkir()
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;

			$data = DB::select("SELECT CURRENT_DATE() as tgl,a.nik,a.nama,departemen,tgl_masuk FROM (
										SELECT a.nik,b.nama,c.departemen,tgl_masuk 
										FROM  tabsen AS a  LEFT JOIN  tkaryawan AS b ON a.nik = b.nik 
										LEFT JOIN tdepartemen AS c ON b.iddepartemen = c.iddepartemen 
										WHERE a.tgl_masuk = CURRENT_DATE()
									) AS subquery 
									RIGHT JOIN  tkaryawan AS a ON  subquery.nik = a.`nik` left join tmgroup_kerja as b ON a.idgroup = b.idmgroup_kerja left join tjadwal_kerja as c ON a.idgroup = c.idmgroup_kerja left join tparameter as d ON c.idparameter = d.idparameter where c.tgl = CURRENT_DATE() and subquery.tgl_masuk is null");
			
			$collect = collect($data);
			return $paginationData = new LengthAwarePaginator(
                         $collect->forPage($page, $perPage),
                         $collect->count(), 
                         $page, 
                         $perPage,
						[
							'path' => LengthAwarePaginator::resolveCurrentPath(),
							'pageName' => 'page',
						]
                       );
		}
		
		public function pelanggaran_baru()
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;
			
			$data = DB::select("SELECT  a.tgl,b.nik,b.nama,c.departemen,d.sangsi 
									FROM tpelanggaran AS a LEFT JOIN tkaryawan AS b ON a.idkaryawan = b.idkaryawan 
									LEFT JOIN tdepartemen AS c ON b.iddepartemen = c.iddepartemen
									LEFT JOIN tsangsi AS d ON a.idsangsi = d.`idsangsi` where  status is null and DATEDIFF(CURRENT_DATE(),a.tglmulai_sangsi) < 14");
			
			$collect = collect($data);
			return $paginationData = new LengthAwarePaginator(
                         $collect->forPage($page, $perPage),
                         $collect->count(), 
                         $page, 
                         $perPage,
						[
							'path' => LengthAwarePaginator::resolveCurrentPath(),
							'pageName' => 'page',
						]
                       );
		}
		
		public function pelanggaran_aktif()
		{
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;

			$data = DB::select("SELECT  a.tgl,b.nik,b.nama,c.departemen,d.sangsi 
									FROM tpelanggaran AS a LEFT JOIN tkaryawan AS b ON a.idkaryawan = b.idkaryawan 
									LEFT JOIN tdepartemen AS c ON b.iddepartemen = c.iddepartemen
									LEFT JOIN tsangsi AS d ON a.idsangsi = d.`idsangsi` where  status is null and DATEDIFF(CURRENT_DATE(),a.tglmulai_sangsi) > 14");
			
			$collect = collect($data);
			return $paginationData = new LengthAwarePaginator(
                         $collect->forPage($page, $perPage),
                         $collect->count(), 
                         $page, 
                         $perPage,
						[
							'path' => LengthAwarePaginator::resolveCurrentPath(),
							'pageName' => 'page',
						]
                       );
		}
		public function habis_kontrak()
		{
			
			$page = \Request::get('page') ?: 1;
			$perPage = \Request::get('perpage') ?: 100;

			$data = DB::select("SELECT 		a.idkaryawan,a.pin,a.nik,a.noktp,a.nobpjs,a.bpjstk,a.nama,a.tempat_lahir,a.tanggal_lahir,a.agama,a.jk,a.jmlcuti,f.name,
				CONCAT_WS(' ',a.alamat, e.name ,f.name,g.name ,h.name) as alt,a.tlp,j.divisi,
				a.hp,b.pendidikan,c.jabatan,d.departemen,i.mgroup_kerja ,a.jobdesk,a.tanggal_masuk,a.tanggal_keluar,a.`tanggal_diangkat`,a.tglhabis_kontrak
				
				FROM tkaryawan AS a LEFT JOIN tpendidikan AS b ON a.idpendidikan = b.`idpendidikan`
				LEFT JOIN tjabatan AS c ON a.`idjabatan` = c.`idjabatan`
				LEFT JOIN tdepartemen AS d ON a.`iddepartemen` = d.`iddepartemen` left join villages as e ON a.iddesa = e.id
				left join districts as f on a.idkecamatan = f.id
				left join regencies as g on a.idkota = g.id
				left join provinces as h on a.idpropinsi = h.id
				left join tmgroup_kerja as i on a.idgroup = i.idmgroup_kerja
				left join tdivisi as j on a.iddivisi = j.iddivisi where DATEDIFF(CURRENT_DATE(), a.tglhabis_kontrak) < 30 ");
			
			$collect = collect($data);
			return $paginationData = new LengthAwarePaginator(
                         $collect->forPage($page, $perPage),
                         $collect->count(), 
                         $page, 
                         $perPage,
						[
							'path' => LengthAwarePaginator::resolveCurrentPath(),
							'pageName' => 'page',
						]
                       );
		}
		
}
