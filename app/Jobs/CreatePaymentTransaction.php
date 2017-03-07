<?php

namespace API\Jobs;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use API\Models\Customer;
use API\Models\Transactions\Payment;

class CreatePaymentTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    protected $_customer;
    protected $_payment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Payment $payment = null, Customer $customer = null)
    {
        $this->_payment = $payment;
        $this->_customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info(date('c'));
        // Log::debug([$this->_customer, $this->_payment]);
        // $this->_customer->payments()->save($this->_payment);
    }
}
