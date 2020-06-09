<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mtransportlembur extends Model
{
	public $timestamps = false;
	public $updated_at = false;
	public $created_at = false;
    protected $table = 'ttransportlembur';
	protected $primaryKey = 'idtransportlembur';
	protected $fillable = [
        'slug', 'title', 'body'
    ];

}
