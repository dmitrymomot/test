<?php

namespace API\Http\Controllers;

use API\Payment;
use Illuminate\Http\Request;

class CustomerTransactionsController extends Controller
{
    /**
     * Create deposit
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \API\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function deposit(Request $request, Customer $customer)
    {

    }

    /**
     * Create withdrawal
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \API\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function withdraw(Request $request, Customer $customer)
    {

    }
}
