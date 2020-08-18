<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = ['product_id', 'prod_owner', 'prod_photo', 'prod_area', 'prod_price', 'prod_owner_phone'];

    /***** Relations *****/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /***** getter & setter *****/
    public function getProdPhotoAttribute()
    {
        return explode('|', $this->attributes['prod_photo']);
    }

    public function getProdPhotos()
    {
        return explode('|', $this->attributes['prod_photo']);
    }
}
