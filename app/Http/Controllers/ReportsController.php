<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

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

    }
}
