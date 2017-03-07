<?php

namespace API\Jobs;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use API\Http\Requests\CustomerDepositRequest;
use API\Models\Customer;
use API\Models\Transactions\Payment;

class CreateDepositTransaction
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CustomerDepositRequest $request, Customer $customer)
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
        $deposit = (new Payment($this->_request->all()));
        $deposit->customer_id = $this->_customer->id;
        $deposit->type = Payment::DEPOSIT;
        $result = $this->_customer->payments()->save($deposit);
    }
}
