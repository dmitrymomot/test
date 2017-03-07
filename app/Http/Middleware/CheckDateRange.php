<?php

namespace API\Http\Middleware;

use Closure;
use Validator;
use Carbon\Carbon;

class CheckDateRange
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
        $params = [];
        if ($request->start_date)
            $params['start_date'] = $request->start_date;
        if ($request->end_date)
            $params['end_date'] = $request->end_date;

        $validator = Validator::make($params, [
            'start_date' => 'date_format:Y-m-d|before:today',
            'end_date' => 'date_format:Y-m-d|after_or_equal:start_date|before:today',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            abort(400, $errors->first());
        }

        $request->merge([
            'start_date' => new Carbon($request->start_date),
            'end_date' => new Carbon($request->end_date),
        ]);

        return $next($request);
    }
}
