<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallPlan extends Model
{
    protected $table = 'call_plans';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'planName',
        'planMinutes'
    ];

    private $callPlansTotal = 0;
    private $callPlans      = [];
    private $callPlansNames = [];

    public function __construct()
    {
        $this->feedThisInstance();
    }

    /**
     * Sets a value to private callPlansTotal variable
     *
     * @param  int
     * @return nill
     */
    public function setCallPlansTotal($total = 0)
    {
        $this->callPlansTotal = $total;
    }

    /**
     * Gets the value of private callPlansTotal variable
     *
     * @return int
     */
    public function getCallPlansTotal()
    {
        return $this->callPlansTotal;
    }

    /**
     * Sets a value to private callPlans variable
     *
     * @param  array
     * @return nill
     */
    public function setCallPlans($dataArray = [])
    {
        $this->callPlans = $dataArray;
    }

    /**
     * Gets the value of private callPlans variable
     *
     * @return array
     */
    public function getCallPlans()
    {
        return $this->callPlans;
    }

    /**
     * Sets a value to private callPlansNames variable
     *
     * @param  array
     * @return nill
     */
    public function setCallPlansNames($dataArray = [])
    {
        $this->callPlansNames = $dataArray;
    }

    /**
     * Gets the value of private callPlansNames variable
     *
     * @return array
     */
    public function getCallPlansNames()
    {
        return $this->callPlansNames;
    }

    /**
     * Sets all required private variables values of $this instance
     *
     * @return nill
     */
    public function feedThisInstance()
    {
        $this->setCallPlansTotalToInstance();
        $this->setCallPlansToInstance();
        $this->setCallPlansNamesToInstance();
    }

    /**
     * Sets the total of base call plans to private callPlansTotal variable
     *
     * @return nill
     */
    public function setCallPlansTotalToInstance()
    {
        $baseCallPlans    = $this->getRawBaseCallPlansData();
        $totalOfCallPlans = count($baseCallPlans);
        $this->setCallPlansTotal($totalOfCallPlans);
    }

    /**
     * Sets the array of base call plans to private callPlans variable
     *
     * @return nill
     */
    public function setCallPlansToInstance()
    {
        $baseCallPlans = $this->getRawBaseCallPlansData();
        $this->setCallPlans($baseCallPlans);
    }

    /**
     * Sets the array of base call plan names to private callPlansNames variable
     *
     * @return nill
     */
    public function setCallPlansNamesToInstance()
    {
        $baseCallPlans = $this->getRawBaseCallPlansData();
        $callPlansNamesArray = [];
        foreach($baseCallPlans as $callPlan){
            $callPlansNamesArray[] = $callPlan['planName'];
        }
        $this->setCallPlansNames($callPlansNamesArray);
    }

    /**
     * Returns the base call plans data
     *
     * @return array
     */
    public function getRawBaseCallPlansData()
    {
        return [
            [
                'planName'    => 'FaleMais 30',
                'planMinutes' => '30'
            ],
            [
                'planName'  => 'FaleMais 60',
                'planMinutes' => '60'
            ],
            [
                'planName'  => 'FaleMais 120',
                'planMinutes' => '120'
            ],
        ];
    }

    /**
     * Checks whether base CallPlans are created
     *
     * @return bool
     */
    public function areAllBaseCallPlansCreated()
    {
        $callPlanNamesArray    = $this->getCallPlansNames();
        $callPlansObjectsTotal = $this->getCallPlansTotalByPlanNames($callPlanNamesArray);
        $totalOfCallPlans      = $this->getCallPlansTotal();
        return ($callPlansObjectsTotal == $totalOfCallPlans ? true : false);
    }

    /**
     * Creates non existent base CallPlans
     *
     * @return int
     */
    public function createBaseCallPlans()
    {
        $baseCallPlans                 = $this->getCallPlans();
        $callPlansObjectPlanNamesArray = $this->getCallPlansNames();
        $createdObjects                = [];
        foreach($baseCallPlans as $callPlan){
            if(in_array($callPlan['planName'], $callPlansObjectPlanNamesArray))
                continue;
            $newObject = $this::create(
                $callPlan
            );
            if(is_object($newObject))
                $createdObjects[] = $newObject;
        }
        return count($createdObjects);
    }

    /**
     * Returns all CallPlans
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCallPlans()
    {
        return $this::where('id', '>', '0')->get();
    }

    /**
     * Returns the total number of all CallPlans matching sent names
     *
     * @param  array
     * @return int
     */
    public function getCallPlansTotalByPlanNames($planNamesArray = [])
    {
        return $this::whereIn('planName', $planNamesArray)->count();
    }

    /**
     * Returns all CallPlans matching sent names
     *
     * @param  array
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCallPlansByPlanNames($planNamesArray = [])
    {
        return $this::whereIn('planName', $planNamesArray)->get();
    }

    /**
     * Calculates the price of a CallPlan
     *
     * @param  array [
     *                   <string> 'origin'            (the origin call DDD),
     *                   <string> 'destination'       (the destination call DDD),
     *                   <int>    'callTimeInMinutes' (the duration of the call in minutes)
     *               ]
     * @return float
     */
    public function calculatePrice($parameters = [])
    {
        if(count($parameters) == 0)
            return false;
        $originDDD         = (array_key_exists('origin',            $parameters) ? $parameters['origin']            : null);
        $destinationDDD    = (array_key_exists('destination',       $parameters) ? $parameters['destination']       : null);
        $callTimeInMinutes = (array_key_exists('callTimeInMinutes', $parameters) ? $parameters['callTimeInMinutes'] : null);
        if(!$originDDD || !$destinationDDD || !$callTimeInMinutes)
            return false;
        if(!$this->callTimeExceedsPlanFreeTime($callTimeInMinutes))
            return 0;
        return $this->calculateExceededPrice($callTimeInMinutes, $originDDD, $destinationDDD);
    }

    /**
     * Checks whether sent call duration in minutes is bigger than $this planMinutes
     *
     * @param  int 
     * @return bool
     */
    public function callTimeExceedsPlanFreeTime($callTimeInMinutes = 0)
    {
        return ($callTimeInMinutes > $this->planMinutes ? true : false);
    }

    /**
     * Returns the calculated price of the exceed time of a callPlan accordingly to callTimeInMinutes, originDDD and destinationDDD 
     *
     * @return float or <false>
     */
    public function calculateExceededPrice($callTimeInMinutes = 0, $originDDD = null, $destinationDDD = null)
    {
        $exceedingMinutes = $this->getExceedingMinutes($callTimeInMinutes);
        $dddCodeValue = (new DddCodesValue())->getDDDCodesObjectsByOriginAndDestination($originDDD, $destinationDDD);
        if(!$dddCodeValue instanceof DddCodesValue)
            return false;
        return $dddCodeValue->calculatePricePerMinute($exceedingMinutes);
    }

    /**
     * Gets the excedding time accordingly to $this callPlan and callTimeInMinutes
     *
     * @return nill
     */
    public function getExceedingMinutes($callTimeInMinutes = 0)
    {
        return abs($this->planMinutes - $callTimeInMinutes);
    }
}
