<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mjadwal_kerja extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tjadwal_kerja';
	protected $primaryKey = 'idjadwal_kerja';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
