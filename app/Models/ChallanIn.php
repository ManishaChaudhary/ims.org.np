<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallanIn extends Model
{
    protected $table = "challan_ins";

    protected $fillable = [
        'party',
        'user_id',
        'in_date',
        'vehicle_no',
        'weight',
        'company_id',
        'godown_id',
        'product_details'
    ];

    protected $casts = [
        'in_details' => 'array'
    ];

    protected $primaryKey = 'id';

    public function godown()
    {
        return $this->belongsTo('App\Models\Godown', 'godown_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function productBatch()
    {
        return $this->belongsTo('App\Models\ProductBatch', 'company_id');
    }
}
