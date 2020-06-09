<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mparameter extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tparameter';
	protected $primaryKey = 'idparameter';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
