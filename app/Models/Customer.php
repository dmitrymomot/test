<?php

namespace API\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function payments()
    {
        return $this->hasMany('\API\Models\Transactions\Payment');
    }

    public function bonuses()
    {
        return $this->hasMany('\API\Models\Transactions\Bonus');
    }
}
