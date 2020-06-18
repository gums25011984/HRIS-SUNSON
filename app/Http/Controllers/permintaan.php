<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class permintaan extends Controller
{

	  public function index(Request $request)
		{
			
		
		$srch = $request->srch; 
	/*	$tableIds = DB::select( DB::raw("SELECT idjabatan,jabatan,'' as karyawan FROM tjabatan"));*/
		$tableIds = DB::select( DB::raw("SELECT a.idkaryawan,a.pin,a.nik,a.noktp,a.nobpjs,a.bpjstk,a.nama,a.tempat_lahir,a.tanggal_lahir,a.agama,
IF (a.jk = 'P', 'Perempuan','Laki-Laki') AS jk,
TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) AS umur,
				CONCAT_WS(' ',a.alamat, e.name ,f.name,g.name ,h.name) AS alt,a.tlp,j.divisi,
				a.hp,b.pendidikan,c.jabatan,d.departemen,i.mgroup_kerja ,a.jobdesk,a.tanggal_masuk,a.tanggal_keluar,a.`tanggal_diangkat`,a.reportLevel1,a.idReportLevel1,a.reportLevel2,a.idReportLevel2,a.reportLevel3,a.idReportLevel3,a.photo
				
				FROM tkaryawan AS a LEFT JOIN tpendidikan AS b ON a.idpendidikan = b.`idpendidikan`
				LEFT JOIN tjabatan AS c ON a.`idjabatan` = c.`idjabatan`
				LEFT JOIN tdepartemen AS d ON a.`iddepartemen` = d.`iddepartemen` LEFT JOIN villages AS e ON a.iddesa = e.id
				LEFT JOIN districts AS f ON a.idkecamatan = f.id
				LEFT JOIN regencies AS g ON a.idkota = g.id
				LEFT JOIN provinces AS h ON a.idpropinsi = h.id
				LEFT JOIN tmgroup_kerja AS i ON a.idgroup = i.idmgroup_kerja
				LEFT JOIN tdivisi AS j ON a.iddivisi = j.iddivisi where nik like '$srch%' or nama like '$srch%'"));
        $jsonResult = array();
		
		
		
        for($i = 0;$i < count($tableIds);$i++)
        {
			$jsonResult[$i]["idkaryawan"] = $tableIds[$i]->idkaryawan;
			$jsonResult[$i]["nik"] = $tableIds[$i]->nik;
			$jsonResult[$i]["nama"] = $tableIds[$i]->nama;
			$jsonResult[$i]["gender"] = $tableIds[$i]->jk;
			$jsonResult[$i]["age"] = $tableIds[$i]->umur;
			$jsonResult[$i]["picture"] = $tableIds[$i]->photo;
			$jsonResult[$i]["jabatan"] = $tableIds[$i]->jabatan;
			$jsonResult[$i]["divisi"] = $tableIds[$i]->divisi;
			$jsonResult[$i]["departemen"] = $tableIds[$i]->departemen;
			$jsonResult[$i]["tanggal_masuk"] = $tableIds[$i]->tanggal_masuk;
			$jsonResult[$i]["divisi"] = $tableIds[$i]->divisi;
			
			$jsonResult[$i]["reportLevel1"] = $tableIds[$i]->reportLevel1;
			$jsonResult[$i]["idReportLevel1"] = $tableIds[$i]->idReportLevel3;
			
			$jsonResult[$i]["reportLevel2"] = $tableIds[$i]->reportLevel2;
			$jsonResult[$i]["idReportLevel2"] = $tableIds[$i]->idReportLevel2;
			
			$jsonResult[$i]["reportLevel3"] = $tableIds[$i]->reportLevel3;
			$jsonResult[$i]["idReportLevel3"] = $tableIds[$i]->idReportLevel3;

        }

		
	    $data = $this->paginate($jsonResult);
		
        return $data;
		}

		
		public function paginate($items,$perPage=2,$pageStart=1)
    {

        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
}
