<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{

    protected $table = "product_batches";

    protected $fillable = [
        'name', 'quantity','alt_qty','category_id','user_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

}
