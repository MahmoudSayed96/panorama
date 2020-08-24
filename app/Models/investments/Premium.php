<?php

namespace App\Models\Investments;

use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    protected $table = 'premia';

    protected $fillable = ['client_name', 'client_phone', 'details', 'alqist_amount', 'remaining_amount', 'end_amount_date'];
}
