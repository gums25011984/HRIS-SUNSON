<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\mhkaryawan;
class chkaryawan extends Controller
{
	  public function index()
		{
			
		$parents = mhkaryawan::all();
        foreach ($parents as $parent) {
			$childs = DB::select("SELECT idjabatan,jabatan from tjabatan ");
            /*$childs = Category::where('parent_id', $parent->id)->where('status', 1)->orderBy('sort_order', 'asc')->get();*/
            if (count($childs) > 0) {
                $subCat = array();
                $players = array();
                $roster[$parent->name] = $players;
                        foreach ($childs as $i => $child) {
                             $subchilds = DB::select("SELECT a.iddepartemen,a.idkaryawan,a.nik,a.nama,b.jabatan 
FROM tkaryawan AS a LEFT JOIN tjabatan AS b ON a.idjabatan = b.idjabatan left join tdepartemen as c ON a.iddepartemen = c.iddepartemen where a.iddepartemen ='$parent->iddepartemen' and a.idjabatan ='$child->idjabatan' ");
                            if (count($subchilds) > 0) {

                                $roster['Departemen :' .$parent->departemen][$child->jabatan] = $subCat;
                                foreach ($subchilds as $subchild) {

                                    $roster[$parent->departemen][$child->jabatan][$subchild->idkaryawan] = $subchild->nama;
                                }

                            }else{
                                $roster[$parent->departemen][$child->jabatan] = $players;
                            }
                        }

            }
        }
		$res['message'] = "Success!";
		$res['values'] = $roster;
        return $res;
			
		}
		
		
}
