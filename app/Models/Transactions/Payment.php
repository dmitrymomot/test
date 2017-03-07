<?php

namespace API\Models\Transactions;

use DB;
use Illuminate\Database\Eloquent\Model;
use API\Events\Transactions\Deposit as DepositEvent;

class Payment extends Model
{
    /**
     * Transaction type
     */
    const DEPOSIT = 'deposit';
    const WITHDRAW = 'withdrawal';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['amount'];

    /**
     * @return related instance of \API\Models\Customer
     */
    public function customer()
    {
        return $this->belongsTo('\API\Models\Customer');
    }

    /**
     * Get customer's balance
     *
     * @param integer $customer_id
     * @param boolean $money_format  // Set true, if you want to get balance in money format
     * @return integer|string
     */
    public function getCustomerBalance($customer_id, $money_format = false)
    {
        $result = $this
            ->where('customer_id', $customer_id)
            ->sum(DB::raw('if(type = \''.Payment::DEPOSIT.'\', `amount`, (-1 * `amount`))'));
        return ($money_format) ? sprintf("%01.2f", $result/100) : $result;
    }

    /**
     * @return boolean
     */
    public function isDeposit()
    {
        return ($this->type === self::DEPOSIT);
    }

    /**
     * @return boolean
     */
    public function isWithdrawal()
    {
        return ($this->type === self::WITHDRAW);
    }

    /**
     * Convert amount to cents
     *
     * @param float|decimal|integer $value
     * @return void
     */
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = intval($value * 100);
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function($payment) {
            if ($payment->isDeposit())
                event(new DepositEvent($payment));
        });
    }
}
