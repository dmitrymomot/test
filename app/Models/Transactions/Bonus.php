<?php

namespace API\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    /**
     * Transaction type
     */
    const INCOME = 'income';
    const EXPENSE = 'expense';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bonus_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['amount'];

    public function customer()
    {
        return $this->belongsTo('\API\Models\Customer');
    }

    public function payment()
    {
        return $this->belongsTo('\API\Models\Transactions\Payment');
    }
}
