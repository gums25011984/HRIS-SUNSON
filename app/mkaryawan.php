<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mkaryawan extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tkaryawan';
	protected $primaryKey = 'idkaryawan';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
