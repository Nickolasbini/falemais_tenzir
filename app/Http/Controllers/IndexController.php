<?php

namespace App\Http\Controllers;

use App\Models\CallPlan;
use App\Models\DddCodesValue;

class IndexController extends Controller
{
    /**
     * Gathers required data for homepage view
     *
     * @param  int   the value to increase
     * @param  int   the percentage to use
     * @return view  with array = [
     *                                <array>     'currentDDDs' => the base DddCodesValue,
     *                                <obj array> 'callPlans'   => all CallPlans created 
     *                            ]
     */
    public function homepage()
    {
        $currentDDDs = DddCodesValue::CURRENT_DDD;
        $callPlansObj = new CallPlan();
        $callPlans = $callPlansObj->getAllCallPlans();

        return view('homepage')->with([
            'currentDDDs' => $currentDDDs,
            'callPlans'   => $callPlans
        ]);
    }
}