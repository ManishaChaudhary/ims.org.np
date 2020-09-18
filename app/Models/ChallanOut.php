<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallanOut extends Model
{
    protected $table = "challan_outs";

    protected $fillable = [
        'party',
        'out_date',
        'vehicle_no',
        'company_id',
        'godown_id',
        'product_details',
    ];

    protected $casts = [
        'out_details' => 'array'
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
