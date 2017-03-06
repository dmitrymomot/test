<?php

namespace API\Http\Controllers;

use API\Models\Customer;
use Illuminate\Http\Request;
use API\Http\Requests\StoreCustomer;
use API\Http\Requests\UpdateCustomer;

class CustomersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function store(StoreCustomer $request)
    {
        $customer = (new Customer($request->all()))->save();
        return response()->json(['data' => $customer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \API\Customer  $customer
     * @return json
     */
    public function show(Customer $customer)
    {
        return response()->json(['data' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \API\Customer  $customer
     * @return json
     */
    public function update(UpdateCustomer $request, Customer $customer)
    {
        $customer = $customer->update($request->all());
        return response()->json(['data' => $customer]);
    }
}
