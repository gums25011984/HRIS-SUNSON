<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mjabatan extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tjabatan';
	protected $primaryKey = 'idjabatan';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
