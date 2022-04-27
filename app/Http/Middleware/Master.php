<?php

namespace App\Http\Middleware;

use App\Models\CallPlan;
use App\Models\DddCodesValue;
use Closure;
use Illuminate\Http\Request;

class Master extends \App\Http\Controllers\Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->sanitazeValues($request);
        $this->checkBaseDDDCodesValue();
        $this->checkBaseCallPlans();
        return $next($request);
    }

    /**
     * Checks whether base DddCodesValue are all created as expected, calling DddCodesValue creation method in case they aren't.
     *
     * @return nill
     */
    public function checkBaseDDDCodesValue()
    {
        $dddCodesValuesObject = new DddCodesValue();
        if(!$dddCodesValuesObject->areAllBaseDDDCodesCreated())
            $dddCodesValuesObject->createBaseDDDCodes();
    }

    /**
     * Checks whether base CallPlans are all created as expected, calling CallPlans creation method in case they aren't.
     *
     * @return nill
     */
    public function checkBaseCallPlans()
    {
        $callPlanObject = new CallPlan();
        if(!$callPlanObject->areAllBaseCallPlansCreated())
            $callPlanObject->createBaseCallPlans();
    }

    /**
     * Sanitazes request parameters by stripping out the HTML scpecial chars
     *
     * @param  \Illuminate\Http\Request  $request
     * @return nill
     */
    public function sanitazeValues($request)
    {
        $allParameters = $request->all();
        foreach($allParameters as $parameterKey => $parameterValue){
            $filteredValue = filter_var($parameterValue, FILTER_SANITIZE_SPECIAL_CHARS);
            $request->merge([$parameterKey => $filteredValue]);
        }
    }
}
