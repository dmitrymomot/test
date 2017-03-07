<?php

use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(API\Models\Customer::class, 50)
            ->create()
            ->each(function ($customer) {
                $customer
                    ->payments()
                    ->save(factory(API\Models\Transactions\Payment::class)
                    ->make());
            });
    }
}
