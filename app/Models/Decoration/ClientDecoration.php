<?php

namespace App\Models\Decoration;

use Illuminate\Database\Eloquent\Model;

class ClientDecoration extends Model
{
    protected $table = 'client_decorations';
    protected $fillable = ['client_name', 'client_phone', 'photos', 'paid_amount', 'delivered_date'];

    /***** getter & setter *****/
    public function getPhotosAttribute()
    {
        return explode('|', $this->attributes['photos']);
    }
}
