<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table = "companies";

    protected $fillable = [
        'name', 'code', 'phone', 'address', 'status' ,'created_by' , 'updated_by'
    ];

    protected $primaryKey = "id";

    public function scopeActive($query)
    {
            return $query->where('status', 'Active');
    }

    public function godown()
    {
        return $this->hasMany('App\Godown', 'company_id');
    }

    public function created_by()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
