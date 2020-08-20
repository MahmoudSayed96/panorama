<?php

namespace App\Models;

use App\Models\Sales\CompanySales;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'slug'];
    protected $hidden = [];

    /***** Relations *****/
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function companySales()
    {
        return $this->hasMany(CompanySales::class);
    }
}
