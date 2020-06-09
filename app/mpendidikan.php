<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mpendidikan extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tpendidikan';
	protected $primaryKey = 'idpendidikan';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
