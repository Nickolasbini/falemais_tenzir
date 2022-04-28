<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class custom_middleware_base_methodsTest extends TestCase
{
    /**
     * Check if base datas are created 
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('homepage');
        // get here on bd and see if it has the base data
        $response->assertStatus(200);
    }
}
