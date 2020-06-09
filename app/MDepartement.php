<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MDepartement extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'tdepartemen';
	protected $primaryKey = 'iddepartemen';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
