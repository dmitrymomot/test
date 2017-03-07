<?php

namespace API\Http\Middleware;

use Closure;
use API\Models\Transactions\Payment;
use API\Exceptions\MaxWithdrawException;

class MaxWithdraw
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $balance = (new Payment)->getCustomerBalance($request->customer->id);
        $withdraw_amount = $request->amount * 100;
        if ($withdraw_amount > $balance)
            throw new MaxWithdrawException(null, [
                'sum' => sprintf("%01.2f", $balance/100),
                'withdrawal' => sprintf("%01.2f", $request->amount),
            ]);

        return $next($request);
    }
}
