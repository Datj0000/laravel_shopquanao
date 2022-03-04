<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'category_id', 'brand_id', 'product_name', 'product_price', 'product_desc', 'product_status', 'product_image',
        'product_quantity', 'product_sold', 'product_tags', 'product_views', 'product_top', 'product_slug'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function category()
    {
        return $this->belongsTo('App\Models\CategoryProductModel', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
}
