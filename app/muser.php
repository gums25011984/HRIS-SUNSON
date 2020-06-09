<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class muser extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'syssuser';
	protected $primaryKey = 'iduser';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
