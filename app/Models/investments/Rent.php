<?php

namespace App\Models\Investments;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = 'rents';
    protected $fillable = ['product_id', 'client_name', 'client_phone', 'contract_type', 'price'];

    /***** Relations *****/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
