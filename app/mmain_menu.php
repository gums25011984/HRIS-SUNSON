<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmain_menu extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'sysappmenu';
	protected $primaryKey = 'idmenu';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
