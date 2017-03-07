<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Str;
use API\Models\Customer;
use API\Models\Transactions\Payment;

class TransactionsTest extends TestCase
{
    /**
     * @return void
     */
    public function testCustomerDeposit()
    {
        $customer = Customer::orderBy('id', 'DESC')->first();

        $data = [
            'amount' => 100.00,
        ];

        $response = $this->json('POST', 'api/customers/'.$customer->id.'/deposit', $data);

        sleep(10);

        $data['type'] = Payment::DEPOSIT;
        $data['customer_id'] = $customer->id;
        $data['amount'] = intval($data['amount'] * 100);

        $response
            ->assertJson(['data' => $data])
            ->assertStatus(200);

        $this->assertDatabaseHas('payment_transactions', $data);
    }

    /**
     * @return void
     */
    public function testCustomerWithdrawOverBalance()
    {
        $customer = Customer::orderBy('id', 'DESC')->first();

        $data = [
            'amount' => 110.00,
        ];

        $response = $this->json('POST', 'api/customers/'.$customer->id.'/withdraw', $data);

        $data['type'] = Payment::WITHDRAW;
        $data['customer_id'] = $customer->id;
        $data['amount'] = intval($data['amount'] * 100);

        $response->assertStatus(400);

        $this->assertDatabaseMissing('payment_transactions', $data);
    }

    /**
     * @return void
     */
    public function testCustomerWithdraw()
    {
        $customer = Customer::orderBy('id', 'DESC')->first();

        $data = [
            'amount' => 100.00,
        ];

        $response = $this->json('POST', 'api/customers/'.$customer->id.'/withdraw', $data);

        $data['type'] = Payment::WITHDRAW;
        $data['customer_id'] = $customer->id;
        $data['amount'] = intval($data['amount'] * 100);

        $response
            ->assertJson(['data' => $data])
            ->assertStatus(200);

        $this->assertDatabaseHas('payment_transactions', $data);
    }
}
