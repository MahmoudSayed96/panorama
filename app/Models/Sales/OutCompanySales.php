<?php

namespace App\Models\Sales;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class OutCompanySales extends Model
{
    protected $table = 'out_company_sales';
    protected $fillable = ['product_id', 'buyer_name', 'buyer_phone', 'price', 'wasit', 'indication'];

    /***** Scopes *****/
    public function scopeWasit($query)
    {
        return $query->where('wasit', 1);
    }

    /***** setter & getter */
    public function getWasit()
    {
        return $this->attributes['wasit'] == 1 ? 'نعم' : 'لا';
    }

    /***** Relations *****/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
