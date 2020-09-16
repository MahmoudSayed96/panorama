<?php

namespace App\Models\Constructions;

use Illuminate\Database\Eloquent\Model;

class CompanyConstruction extends Model
{
    // protected $table = 'company_consultings';
    protected $fillable = ['client_name', 'client_phone', 'project_address', 'paid_amount', 'reaming_amount', 'project_details', 'photos'];

    /***** getter & setter *****/
    public function getPhotosAttribute()
    {
        return explode('|', $this->attributes['photos']);
    }
}
