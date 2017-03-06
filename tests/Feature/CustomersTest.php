<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Str;
use API\Models\Customer;

class CustomersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateCustomer()
    {
        $data = [
            'first_name' => Str::ucfirst(Str::lower(Str::random(5))),
            'last_name' => Str::ucfirst(Str::lower(Str::random(5))),
            'gender' => 'male',
            'country' => 'Malta',
        ];
        $data['email'] = $data['first_name'].'@test.dev';

        $response = $this->json('POST', 'api/customers', $data);

        $response
            ->assertJson(['data' => $data])
            ->assertStatus(200);

        $this->assertDatabaseHas('customers', $data);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateCustomer()
    {
        $customer = Customer::orderBy('id', 'DESC')->first();

        $data = [
            'first_name' => Str::ucfirst(Str::lower(Str::random(5))),
            'last_name' => Str::ucfirst(Str::lower(Str::random(5))),
            'country' => 'Malta',
        ];
        $data['email'] = $data['first_name'].'@test.dev';

        $response = $this->json('PUT', 'api/customers/'.$customer->id, $data);

        $data['id'] = $customer->id;

        $response
            ->assertJson(['data' => $data])
            ->assertStatus(200);

        $this->assertDatabaseHas('customers', $data);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCustomer()
    {
        $customer = Customer::orderBy('id', 'DESC')->first();
        $response = $this->json('GET', 'api/customers/'.$customer->id);

        $data = $customer->toArray();

        $response
            ->assertJson(['data' => $data])
            ->assertStatus(200);
    }
}
