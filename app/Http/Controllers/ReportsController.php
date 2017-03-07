<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Queue;
use Carbon\Carbon;
use API\Models\Transactions\Payment;

class ReportsController extends Controller
{
    /**
     * Get summary report
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Carbon\Carbon  $start_date
     * @param  \Carbon\Carbon  $end_date
     * @return \Illuminate\Http\Response
     */
    public function getSummary(Request $request, $start_date = null, $end_date = null)
    {
        $start_date = new Carbon($start_date ?: '- 7 days');
        $end_date = (new Carbon($end_date ?: 'yesterday'))->endOfDay();

        $report = DB::table('payment_transactions')
            ->join('customers', 'customers.id', '=', 'payment_transactions.customer_id')
            ->select(
                DB::raw('DATE(payment_transactions.created_at) as date'),
                'customers.country as country',
                DB::raw('COUNT(DISTINCT customers.id) as unique_customers'),
                DB::raw('SUM(if(type = \''.Payment::DEPOSIT.'\', 1, 0)) as no_of_deposits'),
                DB::raw('SUM(if(type = \''.Payment::DEPOSIT.'\', amount, 0)) as total_deposit_amount'),
                DB::raw('SUM(if(type = \''.Payment::WITHDRAW.'\', 1, 0)) as no_of_withdrawal'),
                DB::raw('SUM(if(type = \''.Payment::WITHDRAW.'\', amount, 0)) as total_withdrawal_amount')
            )
            ->whereBetween('payment_transactions.created_at', [$start_date, $end_date])
            ->groupBy(DB::raw('DATE(payment_transactions.created_at), customers.country'))
            ->get();

        return response()->json(['data' => $report]);
    }
}
