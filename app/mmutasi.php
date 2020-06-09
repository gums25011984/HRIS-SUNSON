<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmutasi extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tmutasi';
	protected $primaryKey = 'idmutasi';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
