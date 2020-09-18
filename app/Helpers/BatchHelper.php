<?php

namespace App\Helpers;


use App\Models\Product;
use App\Models\ProductBatch;

class BatchHelper
{
    public function batchQuantity($id)
    {
        $quantity = collect(Product::where('batch_id', $id)->select('quantity')->get());
        return $quantity->sum('quantity');
    }

    public function batchAltQuantity($id)
    {
        $altQuantity = collect(Product::where('batch_id', $id)->select('alt_quantity')->get());
        return $altQuantity->sum('alt_quantity');
    }

    public function getBatch($id)
    {
        $batch = ProductBatch::findOrFail($id);
        return $batch;
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function getBatchForDropdown()
    {
        return ProductBatch::pluck('id','title');
    }
}
