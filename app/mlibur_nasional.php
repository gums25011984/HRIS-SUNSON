<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mlibur_nasional extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tlibur_nasional';
	protected $primaryKey = 'idlibur_nasional';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
