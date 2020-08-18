<?php

namespace App\Models;

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
}
