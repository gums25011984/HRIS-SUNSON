<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mpelanggaran extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tpelanggaran';
	protected $primaryKey = 'idpelanggaran';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
