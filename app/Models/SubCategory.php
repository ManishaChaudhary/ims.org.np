<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = "sub_categories";

    protected $fillable = [
        'title','status' ,'category_id' ,'description' ,'created_by', 'updated_by'
    ];

    protected $primaryKey = "id";

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category' ,'category_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product' ,'sub_category_id');
    }

    public function created_by()
    {
        return $this->belongsTo('App\Models\User' , 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo('App\Models\User' , 'updated_by');
    }
}
