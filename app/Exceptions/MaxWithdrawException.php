<?php

namespace API\Exceptions;

use Exception;
use Lang;

class MaxWithdrawException extends Exception
{
    public function __construct($message = null, array $attr = null)
    {
        $message = $message ?: Lang::get('http_responses.max_withdrawal.over_balance', $attr);
        parent::__construct($message, 400);
    }
}
