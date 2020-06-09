<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmgroup_kerja extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tmgroup_kerja';
	protected $primaryKey = 'idmgroup_kerja';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
