<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mijin extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tijin';
	protected $primaryKey = 'idijin';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
