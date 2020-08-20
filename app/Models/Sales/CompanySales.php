<?php

namespace App\Models\Sales;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class CompanySales extends Model
{
    protected $table = "company_sales";
    protected $fillable = ['product_id', 'buyer_name', 'buyer_phone', 'price'];

    /***** Relations *****/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
