<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mhak_akses extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'sysuseraccess';
	protected $primaryKey = 'idjabatan';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
