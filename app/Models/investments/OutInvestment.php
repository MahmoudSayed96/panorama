<?php

namespace App\Models\Investments;

use Illuminate\Database\Eloquent\Model;

class OutInvestment extends Model
{
    protected $table = 'out_investments';
    protected $fillable = ['client_name', 'client_photo', 'client_phone', 'income_details', 'paid_amount', 'total_amount'];
    protected const DS = DIRECTORY_SEPARATOR;

    /**
     * Get photo attribute.
     * 
     */
    public function getClientPhotoAttribute()
    {
        return isset($this->attributes['client_photo']) ? asset($this->attributes['client_photo']) : null;
    }

    public function getPhoto()
    {
        return isset($this->attributes['client_photo']) ? $this->attributes['client_photo'] : null;
    }
}
