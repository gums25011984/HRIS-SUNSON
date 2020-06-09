<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdivisi extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tdivisi';
	protected $primaryKey = 'iddivisi';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
