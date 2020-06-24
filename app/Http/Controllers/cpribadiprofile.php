<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class cpribadiprofile extends Controller
{
	  public function index(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$search = $request->search;
			$perPage = \Request::get('perpage') ?: 10; 
			$data = DB::select("SELECT 		a.idkaryawan,a.pin,a.nik,a.noktp,a.nobpjs,a.bpjstk,a.nama,CONCAT_WS(' - ',a.tempat_lahir,a.tanggal_lahir) as lahir,a.agama,a.jk,a.jmlcuti,f.name,a.photo,
				CONCAT_WS(' ',a.alamat, e.name ,f.name,g.name ,h.name) as alt,CONCAT_WS(' / ',a.tlp,a.hp) as tlp,j.divisi,
				b.pendidikan,c.jabatan,d.departemen,i.mgroup_kerja ,a.jobdesk,a.tanggal_masuk,a.tanggal_keluar,a.`tanggal_diangkat`
				
				FROM tkaryawan AS a LEFT JOIN tpendidikan AS b ON a.idpendidikan = b.`idpendidikan`
				LEFT JOIN tjabatan AS c ON a.`idjabatan` = c.`idjabatan`
				LEFT JOIN tdepartemen AS d ON a.`iddepartemen` = d.`iddepartemen` left join villages as e ON a.iddesa = e.id
				left join districts as f on a.idkecamatan = f.id
				left join regencies as g on a.idkota = g.id
				left join provinces as h on a.idpropinsi = h.id
				left join tmgroup_kerja as i on a.idgroup = i.idmgroup_kerja
				left join tdivisi as j on a.iddivisi = j.iddivisi");

			$data=$this->paginate($data,$perPage);
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
    
		
		public function pribadi_cuti_diambil(Request $request)
		{	
			$page = \Request::get('page') ?: 1;
			$search = $request->search;
			$perPage = \Request::get('perpage') ?: 10; 
			$data = DB::select("SELECT a.idkaryawan,a.tgl,c.nama_perijinan,a.tgl_keluar,a.tgl_kembali,b.qty
			FROM tijin AS a LEFT JOIN tperijinan AS c ON a.`idperijinan` = c.`idperijinan`
			LEFT JOIN
			(
				SELECT b.idijin,COUNT(b.idijin) AS qty FROM tlistcuti AS b GROUP BY b.`idijin`
			) AS b ON a.`idijin` = b.idijin 
			WHERE (a.`idperijinan` IN (19,25,26))");

			$data=$this->paginate($data,$perPage);
			$data->appends($request->all());
			return($data);
		}
		
		public function pribadi_cuti(Request $request)
		{
			$page = \Request::get('page') ?: 1;
			$search = $request->search;
			$perPage = \Request::get('perpage') ?: 10; 
			$data = DB::select("SELECT a.idkaryawan,a.nik,a.nama,IFNULL(e.penggunaan_cuti,0) AS cuti_digunakan,IFNULL(c.cuti_darilembur,0) AS cuti_darilembur,
		IFNULL(t1.cutitahunan,0) AS cutitahunan,IFNULL(b.cutikip,0) AS cutikip,IFNULL(d.cutiip,0) AS cutiip,
		IFNULL(c.cuti_darilembur,0) + IFNULL(t1.cutitahunan,0) + IFNULL(b.cutikip,0) + IFNULL(d.cutiip,0) AS jmlcuti,
		(IFNULL(c.cuti_darilembur,0) + IFNULL(t1.cutitahunan,0) + IFNULL(b.cutikip,0) + IFNULL(d.cutiip,0))-IFNULL(e.penggunaan_cuti,0)  AS sisa_cuti
		FROM tkaryawan AS a LEFT JOIN (
			  SELECT  a.nik,SUM(jmlcuti) AS cutitahunan FROM  tcutitahunan AS a GROUP BY a.nik
			 ) t1  ON a.`nik` = t1.nik LEFT JOIN
			 (
			  SELECT  c.nik,SUM(jmlcuti) AS cutikip FROM  tkip AS c GROUP BY c.nik
			 ) AS b ON a.nik  = b.nik LEFT JOIN 
			 (
			  SELECT  c.nik,COUNT(c.nik) AS cuti_darilembur FROM  tcuti_uang AS c GROUP BY c.nik
			 ) AS c ON a.nik  = c.nik LEFT JOIN
			 (
			  SELECT  d.nik,SUM(jmlcuti) AS cutiip FROM  tip AS d GROUP BY d.nik
			 ) AS d ON a.nik  = d.nik LEFT JOIN 
			 (
			  SELECT  c.idkaryawan,COUNT(idkaryawan) AS penggunaan_cuti FROM  tlistcuti AS c 
			WHERE c.idcuti NOT IN ( 12,13,14,15,16,17,18,20,23,24) 
			  GROUP BY c.idkaryawan
			 ) AS e ON a.idkaryawan  = e.idkaryawan  limit 1000 ");
			
			$data=$this->paginate($data,$perPage);
			$data->appends($request->all());
			return($data);
		}
		
		public function pribadi_ppkl(Request $request)
		{
			$page = \Request::get('page') ?: 1;
				$search = $request->search;
				$perPage = \Request::get('perpage') ?: 10; 
			$data = DB::select("SELECT  a.idspl,a.tgl,a.nospl,CONCAT(jam_mulai, ' - ', jam_berakhir) AS jam,b.nama,
				CASE
				WHEN a.acc = '0' THEN 'Prosess'
				WHEN a.acc is null THEN 'Prosess'
				WHEN a.acc = '1' THEN 'OK'
				WHEN a.acc = '2' THEN 'Ditolak'
				END  AS acc
				FROM tspl AS a LEFT JOIN tkaryawan AS b ON b.idkaryawan = a.permintaan_dari left join tspldtl as d on a.nospl = d.nospl");
			$data=$this->paginate($data,$perPage);
			$data->appends($request->all());
			return($data);
		}
		
}
