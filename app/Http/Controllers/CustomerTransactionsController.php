<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;
use API\Http\Requests\CustomerDepositRequest;
use API\Http\Requests\CustomerWithdrawalRequest;
use API\Models\Customer;
use API\Models\Transactions\Payment;
use API\Jobs\CreateDepositTransaction;
use API\Jobs\CreateWithdrawalTransaction;

class CustomerTransactionsController extends Controller
{
    /**
     * Create deposit
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \API\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function deposit(CustomerDepositRequest $request, Customer $customer)
    {
        dispatch(new CreateDepositTransaction($request, $customer));
        return response()->json(['data' => true]);
    }

    /**
     * Create withdrawal
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \API\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function withdraw(CustomerWithdrawalRequest $request, Customer $customer)
    {
        dispatch(new CreateWithdrawalTransaction($request, $customer));
        return response()->json(['data' => true]);
    }
}
