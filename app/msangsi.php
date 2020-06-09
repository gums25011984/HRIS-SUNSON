<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class msangsi extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tsangsi';
	protected $primaryKey = 'idsangsi';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
