<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'attributes_name', 'attributes_value'
    ];
    protected $primaryKey = 'attributes_id';
 	protected $table = 'tbl_attributes';
}
