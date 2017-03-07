<?php

namespace API\Jobs;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use API\Http\Requests\CustomerWithdrawalRequest;
use API\Models\Customer;
use API\Models\Transactions\Payment;

class CreateWithdrawalTransaction
{
    use Dispatchable, Queueable;

    protected $_customer;
    protected $_request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CustomerWithdrawalRequest $request, Customer $customer)
    {
        $this->_request = $request;
        $this->_customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $withdrawal = (new Payment($this->_request->all()));
        $withdrawal->customer_id = $this->_customer->id;
        $withdrawal->type = Payment::WITHDRAW;
        $result = $this->_customer->payments()->save($withdrawal);
    }
}
