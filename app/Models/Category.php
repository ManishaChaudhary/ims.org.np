<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'title', 'description','product_id','parent_id', 'status', 'created_by', 'updated_by'
    ];

    protected $primaryKey = "id";

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function subCategory()
    {
        $this->hasMany('App\SubCategory', 'category_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function created_by()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function parents()
    {
        return $this->belongsTo('App\Models\Category','parent_id','id') ;
    }

}
