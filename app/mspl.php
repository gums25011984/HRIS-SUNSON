<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mspl extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tspl';
	protected $primaryKey = 'idspl';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
