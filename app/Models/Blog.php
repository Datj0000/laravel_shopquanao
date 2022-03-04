<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'blog_name','blog_views','blog_slug', 'blog_desc','blog_status','blog_image','category_id'
    ];
    protected $primaryKey = 'blog_id';
 	protected $table = 'tbl_blog';
}
