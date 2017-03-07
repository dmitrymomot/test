<?php

namespace API\Models;

use Illuminate\Database\Eloquent\Model;
use API\Events\CustomerCreated as CustomerCreatedEvent;

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

    /**
     * Get bonuses of current user
     *
     * @return instance of \Illuminate\Database\Eloquent\Collection
     */
    public function bonuses()
    {
        return $this->hasMany('\API\Models\Transactions\Bonus');
    }

    /**
     * Get all payments of current user
     *
     * @return instance of \Illuminate\Database\Eloquent\Collection
     */
    public function payments()
    {
        return $this->hasMany('\API\Models\Transactions\Payment');
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function($customer) {
            event(new CustomerCreatedEvent($customer));
        });
    }
}
