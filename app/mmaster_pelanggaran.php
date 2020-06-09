<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmaster_pelanggaran extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tmaster_pelanggaran';
	protected $primaryKey = 'idmaster_pelanggaran';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
