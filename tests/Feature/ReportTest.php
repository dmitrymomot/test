<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Queue;

class ReportTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetDefaultReport()
    {
        $response = $this->json('GET', 'api/reports/summary');
        $response->assertStatus(200);
    }
}
