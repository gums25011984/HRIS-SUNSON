<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class msubmenu extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'sysappmenuitem';
	protected $primaryKey = 'idmenuitem';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
