<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReturnDetail extends Model
{
    protected $table = "product_return_details";

    protected $fillable = [
        'product_return_id',
        'product_id',
        'category_id',
        'subcategory_id',
        'product_batch_id',
        'quantity',
        'alt_quantity'
    ];

    public function products()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory','subcategory_id','id');
    }

    public function productBatch()
    {
        return $this->belongsTo('App\Models\ProductBatch','product_batch_id','id');
    }

}
