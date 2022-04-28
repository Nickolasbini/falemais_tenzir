<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class trying_to_simulate_call_priceTest extends TestCase
{
    /**
     * Trying to use the method GET to request route
     *
     * @return void
     */
    public function test_try_get_method()
    {
        $response = $this->get('simulatecallprice');
        $response->assertStatus(200);
    }

    /**
     * Trying to use the method GET to request route
     *
     * @return void
     */
    public function test_try_simulating_with_no_parameters()
    {
        $response = $this->post(route('simulatecallprice'), []);
        $responseArray = json_decode($response->content(), true);
        $this->assertEquals('true', $responseArray['success']);
    }

    /**
     * Trying simulate the call price with only one parameter 'callPlanId'
     *
     * @return void
     */
    public function test_try_simulating_with_only_callPlanId()
    {
        $response = $this->post(route('simulatecallprice'), [
            'callPlanId' => '1',
        ]);
        $responseArray = json_decode($response->content(), true);
        $this->assertEquals('true', $responseArray['success']);
    }

    /**
     * Trying simulate the call price with only expected parameters but, a string 'callPlanId' variable
     *
     * @return void
     */
    public function test_try_simulating_with_string_callPlanId()
    {
        $response = $this->post(route('simulatecallprice'), [
            'callPlanId'  => 'call plan 1',
            'origin'      => '011',
            'destination' => '017',
            'callTime'    => 35
        ]);
        $responseArray = json_decode($response->content(), true);
        $this->assertEquals('true', $responseArray['success']);
    }

    /**
     * Trying simulate the call price with expected parameters but, a string 'callTime' variable
     *
     * @return void
     */
    public function test_try_simulating_with_string_callTime()
    {
        $response = $this->post(route('simulatecallprice'), [
            'callPlanId'  => 1,
            'origin'      => '011',
            'destination' => '017',
            'callTime'    => 'two minutes'
        ]);
        $responseArray = json_decode($response->content(), true);
        $this->assertEquals('true', $responseArray['success']);
    }

    /**
     * Trying simulate the call price with expected parameters
     *
     * @return void
     */
    public function test_try_simulating_with_expected_parameters()
    {
        $response = $this->post(route('simulatecallprice'), [
            'callPlanId'  => 1,
            'origin'      => '011',
            'destination' => '017',
            'callTime'    => 35
        ]);
        $responseArray = json_decode($response->content(), true);
        $this->assertTrue($responseArray['success']);
    }
}
