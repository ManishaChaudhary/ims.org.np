<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Godown extends Model
{
    protected $table = "godowns";

    protected $fillable = [
        'title', 'code', 'company_id', 'created_by', 'updated_by','status' ,'description','address'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
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
