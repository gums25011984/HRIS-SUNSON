<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MAlat_Kontrasepsi extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'talat_kontrasepsi';
	protected $primaryKey = 'idalat_kontrasepsi';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
