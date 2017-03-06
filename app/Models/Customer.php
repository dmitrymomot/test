<?php

namespace API\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'gender',
        'country',
    ];

    public function payments()
    {
        return $this->hasMany('\API\Models\Transactions\Payment');
    }

    public function bonuses()
    {
        return $this->hasMany('\API\Models\Transactions\Bonus');
    }
}
