<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cspt extends Controller
{
	  public function index()
		{
			
		$parents = DB::select("SELECT a.idijin,b.nama_perijinan,'' as location from tijin as a left join tperijinan as b on a.idperijinan = b.idperijinan ");
        foreach ($parents as $parent) {
			$childs = DB::select("SELECT b.iddivisi,c.divisi,'' as approval  FROM tijin AS a LEFT JOIN tkaryawan as b ON a.idkaryawan = b.idkaryawan left join tdivisi AS c ON b.iddivisi = c.iddivisi  WHERE b.iddivisi > 0 and a.idijin ='$parent->idijin'  ");
            /*$childs = Category::where('parent_id', $parent->id)->where('status', 1)->orderBy('sort_order', 'asc')->get();*/
            if (count($childs) > 0) {
                $subCat = array();
                $players = array();
                $roster[$parent->nama_perijinan] = $players;
                        foreach ($childs as $i => $child) {
                             $subchilds = DB::select("SELECT a.idkaru,b.nama from tijin as a left join tkaryawan as b ON a.idkaryawan = b.idkaryawan where a.idijin ='$parent->idijin' ");
                            if (count($subchilds) > 0) {

                                $roster[$parent->nama_perijinan][$child->divisi] = $subCat;
                                foreach ($subchilds as $subchild) {

                                    $roster[$parent->nama_perijinan][$child->divisi][$subchild->idkaru] = $subchild->nama;
                                }

                            }else{
                                $roster[$parent->idijin][$child->divisi] = $players;
                            }
                        }

            }
        }
		$res['message'] = "Success!";
		$res['values'] = $roster;
        return $res;
			
		}
		
		
}
