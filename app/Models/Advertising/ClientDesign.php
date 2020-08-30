<?php

namespace App\Models\Advertising;

use Illuminate\Database\Eloquent\Model;

class ClientDesign extends Model
{
    protected $table = 'client_designs';
    protected $fillable = ['client_name', 'client_phone', 'photos', 'paid_amount', 'delivered_date'];

    /***** getter & setter *****/
    public function getPhotosAttribute()
    {
        return explode('|', $this->attributes['photos']);
    }
}
