<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mperijinan extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tperijinan';
	protected $primaryKey = 'idperijinan';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
