<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mstatus_pernikahan extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tstatus_pernikahan';
	protected $primaryKey = 'idstatus_pernikahan';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
