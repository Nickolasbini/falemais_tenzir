<?php

namespace Tests\Feature;

use Tests\TestCase;

class custom_middleware_base_methodsTest extends TestCase
{
    /**
     * Check if base dddCodesValues objects are created
     *
     * @return void
     */
    public function test_are_all_base_ddd_codes_value_created()
    {
        $response = $this->get('/');
        $dddCodes = new \App\Models\DddCodesValue();
        $response->assertEquals(true, $dddCodes->areAllBaseDDDCodesCreated());
    }

    /**
     * Check if base callPlans objects are created
     *
     * @return void
     */
    public function test_are_all_base_call_plans_created()
    {
        $response = $this->get('/');
        $callPlans = new \App\Models\CallPlan();
        $response->assertEquals(true, $callPlans->areAllBaseCallPlansCreated());
    }
}
