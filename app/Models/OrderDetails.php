<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'order_id', 'product_id', 'product_name', 'product_price', 'product_quantity', 'product_coupon', 'product_color', 'product_feeship'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
