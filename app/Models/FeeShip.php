<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'fee_matp', 'fee_feeship'
    ];
    protected $primaryKey = 'fee_id';
 	protected $table = 'tbl_feeship';

 	// public function city(){
 	// 	return $this->belongsTo('App\Models\City', 'fee_matp');
 	// }
}
