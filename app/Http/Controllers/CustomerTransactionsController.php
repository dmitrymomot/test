<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;
use API\Http\Requests\CustomerDepositRequest;
use API\Http\Requests\CustomerWithdrawalRequest;
use API\Models\Customer;
use API\Models\Transactions\Payment;
use API\Jobs\CreatePaymentTransaction;
use Queue;

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
        $deposit = (new Payment($request->all()));
        $deposit->customer_id = $customer->id;
        $deposit->type = Payment::DEPOSIT;
        $result = $customer->payments()->save($deposit);

        return response()->json(['data' => $result]);
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
        $withdrawal = (new Payment($request->all()));
        $withdrawal->customer_id = $customer->id;
        $withdrawal->type = Payment::WITHDRAW;
        $result = $customer->payments()->save($withdrawal);

        return response()->json(['data' => $result]);
    }
}
