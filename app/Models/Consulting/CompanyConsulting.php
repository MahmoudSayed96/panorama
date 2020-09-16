<?php

namespace App\Models\Consulting;

use Illuminate\Database\Eloquent\Model;

class CompanyConsulting extends Model
{
    // protected $table = 'company_consultings';
    protected $fillable = ['client_name', 'client_phone', 'project_name', 'project_number', 'piece_number', 'suk_number', 'details', 'photos'];

    /***** getter & setter *****/
    public function getPhotosAttribute()
    {
        return explode('|', $this->attributes['photos']);
    }
}
