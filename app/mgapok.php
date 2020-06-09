<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class mgapok extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tgapok';
	protected $primaryKey = 'idgapok';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
