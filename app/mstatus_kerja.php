<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mstatus_kerja extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tstatus_kerja';
	protected $primaryKey = 'idstatus_kerja';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
