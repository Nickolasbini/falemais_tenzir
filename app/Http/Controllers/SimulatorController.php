<?php

namespace App\Http\Controllers;

use App\Models\CallPlan;

class SimulatorController extends Controller
{
    /**
     * Responsible by simulating the price of a call accordingly to sent callPlan, call origin and destination ddd and callTime in minutes
     *
     * @param  int     callPlanId  (selected plan id)         - required
     * @param  string  origin      (origin call DDD)          - required
     * @param  string  destination (destination call DDD)     - required
     * @param  int     callTime    (call duration in minutes) - required
     * @return json    {
     *                     <bool>   'success' => true on success or false on failure,
     *                     <string> 'message' => correspondent return message
     *                     <int>    'value'   => on success the simulated price on failure <null>
     *                 }     
     */
    public function simulateCallPrice()
    {
        $callPlanId        = $this->getParameter('callPlanId');
        $originDDD         = $this->getParameter('origin');
        $destinationDDD    = $this->getParameter('destination');
        $callTimeInMinutes = $this->getParameter('callTime');
        if(!$callPlanId || !$originDDD || !$destinationDDD || !$callTimeInMinutes){
            return json_encode([
                'success' => false,
                'message' => 'informações faltando',
                'value'   => null
            ]);
        }
        if($originDDD == $destinationDDD){
            return json_encode([
                'success' => false,
                'message' => 'os DDDs devem ser diferentes',
                'value'   => null
            ]);
        }
        $callPlanObj = CallPlan::find($callPlanId);
        if(!$callPlanObj){
            return json_encode([
                'success' => false,
                'message' => 'plano de ligação desconhecido',
                'value'   => null
            ]);
        }
        $parametersForCalculation = [
            'origin'            => $originDDD,
            'destination'       => $destinationDDD,
            'callTimeInMinutes' => $callTimeInMinutes
        ];
        $response = $callPlanObj->calculatePrice($parametersForCalculation);
        if(!is_numeric($response)){
            return json_encode([
                'success' => false,
                'message' => 'um problema inesperado ocorreu, tente novamente',
                'value'   => null
            ]);
        }
        return json_encode([
            'success' => true,
            'message' => 'simulação concluida',
            'value'   => $response
        ]);
    }
}
