<?php

namespace App\Models;

use App\Helpers\PercentageHandler;
use App\Helpers\TableGenerator;
use Illuminate\Database\Eloquent\Model;

class DddCodesValue extends Model
{
    protected $table = 'ddd_codes_value';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'origin',
        'destination',
        'pricePerMinute',
        'identificator'
    ];

    const CURRENT_DDD = ['011', '016', '017', '018'];

    private $identificators;
    private $numberOfCodes;
    private $dddCodesValue;

    public function __construct()
    {
        $this->feedThisInstance();
    }

    /**
     * Sets a value to private numberOfCodes variable
     *
     * @param  int
     * @return nill
     */
    public function setNumberOfCodes($number = 0)
    {
        $this->numberOfCodes = $number;
    }

    /**
     * Gets the value of private numberOfCodes variable
     *
     * @return array
     */
    public function getNumberOfCodes()
    {
        return $this->numberOfCodes;
    }

    /**
     * Sets a value to private identificators variable
     *
     * @param  array
     * @return nill
     */
    public function setIdentificators($value = [])
    {
        $this->identificators = $value;
    }

    /**
     * Gets the value of private identificators variable
     *
     * @param  array
     * @return nill
     */
    public function getIdentificators()
    {
        return $this->identificators;
    }

    /**
     * Sets a value to private dddCodesValue variable
     *
     * @param  array
     * @return nill
     */
    public function setDDDCodesValue($codes = [])
    {
        $this->dddCodesValue = $codes;
    }

    /**
     * Gets the value of private dddCodesValue variable
     *
     * @return array
     */
    public function getDDDCodesValue()
    {
        return $this->dddCodesValue;
    }

    /**
     * Sets all required private variables values of $this instance
     *
     * @return nill
     */
    public function feedThisInstance()
    {
        $this->setDDDCodesValueToInstace();
        $this->setIdentificatorToInstance();
        $this->setNumberOfCodesToInstance();
    }

    /**
     * Sets the identificator array of base ddd codes value to private identificators variable
     *
     * @param  array
     * @return nill
     */
    public function setIdentificatorToInstance()
    {
        $codes = $this->getDDDCodesValue();
        $identificatorsArray = [];
        foreach($codes as $code){
            $identificatorsArray[] = $code['identificator'];
        }
        $this->setIdentificators($identificatorsArray);
    }

    /**
     * Sets the number of codes of base ddd codes value to private numberOfCodes variable
     *
     * @param  array
     * @return nill
     */
    public function setNumberOfCodesToInstance()
    {
        $codes = $this->getDDDCodesValue();
        $originsArray = [];
        foreach($codes as $code){
            $originsArray[] = $code['origin'];
        }
        $numberOfCodes = count($originsArray);
        $this->setNumberOfCodes($numberOfCodes);
    }

    /**
     * Sets the ddd codes value array of base ddd codes value to private dddCodesValue variable
     *
     * @param  array
     * @return nill
     */
    public function setDDDCodesValueToInstace()
    {
        $origins         = ['011', '016', '011', '017', '011', '018'];
        $destinations    = ['016', '011', '017', '011', '018', '011'];
        $pricesPerMinute = [1.90, 2.90, 1.70, 2.70, 0.90, 1.90];
        $identificators  = [1, 2, 3, 4, 5, 6];
        $dddCodesValue = [];
        for($position = 0; $position < count($identificators); $position++){
            $dddCodesValue[] = [
                'origin'         => $origins[$position],
                'destination'    => $destinations[$position],
                'pricePerMinute' => $pricesPerMinute[$position],
                'identificator'  => $identificators[$position]
            ];
        }
        $this->setDDDCodesValue($dddCodesValue);
    }

    /**
     * Checks whether base DddCodesValue are created
     *
     * @return bool
     */
    public function areAllBaseDDDCodesCreated()
    {
        $numberOfCodes         = $this->getNumberOfCodes();
        $identificators        = $this->getIdentificators();
        $totalOfDddCodesValues = $this->getDDDCodesTotalByIndicators($identificators);
        return ($totalOfDddCodesValues == $numberOfCodes ? true : false);
    }

    /**
     * Creates non existent base DddCodesValue
     *
     * @return int
     */
    public function createBaseDDDCodes()
    {
        $baseDDDCodes       = $this->getDDDCodesValue();
        $identificators     = $this->getIdentificators();
        $dddCodesValueObj   = $this->getDDDCodesObjectsByIndicators($identificators);
        $dddCodesIndicators = $this->onlyIndicatorsAsArray($dddCodesValueObj);
        $createdObjects     = [];
        foreach($baseDDDCodes as $dddCode){
            if(in_array($dddCode['identificator'], $dddCodesIndicators))
                continue;
            $newObject = $this::create(
                $dddCode
            );
            if(is_object($newObject))
                $createdObjects[] = $newObject;
        }
        return count($createdObjects);
    }

    /**
     * Returns total number of all DddCodesValue matching identificators sent
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllDDDCodesOrderedByOrigin()
    {
        return DddCodesValue::where('id', '>', '1')->orderBy('origin')->get();
    }

    /**
     * Returns total number of all DddCodesValue matching identificators sent
     *
     * @param  array
     * @return int
     */
    public function getDDDCodesTotalByIndicators($identificators = [])
    {
        return DddCodesValue::whereIn('identificator', $identificators)->count();
    }

    /**
     * Returns all DddCodesValue matching identificators sent
     *
     * @param  array
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDDDCodesObjectsByIndicators($identificators = [])
    {
        return DddCodesValue::whereIn('identificator', $identificators)->get();
    }

    /**
     * Returns all DddCodesValue matching origin and destination sent
     *
     * @param  string
     * @param  string
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDDDCodesObjectsByOriginAndDestination($origin = null, $destination = null)
    {
        $dddCodeObj = DddCodesValue::where('origin', $origin)->where('destination', $destination)->get();
        return ($dddCodeObj->count() > 0 ? $dddCodeObj[0] : []);
    }

    /**
     * Returns an array with indicators only of sent DddCodesValue objects array
     *
     * @param  \Illuminate\Database\Eloquent\Collection
     * @return array
     */
    public function onlyIndicatorsAsArray($dddCodesObj)
    {
        $onlyIndicatorsArray = [];
        foreach($dddCodesObj as $dddCodeObj){
            $onlyIndicatorsArray[] = $dddCodeObj->indicator;
        }
        return $onlyIndicatorsArray;
    }

    /**
     * Calculates the increased price per minute of $this DddCodesValue 
     *
     * @param  int   the exceding minutes
     * @param  int   the percentage to add to exceding minutes
     * @return float
     */
    public function calculatePricePerMinute($exeedingMinutes = 0, $increasedPercentagePerMinute = 10)
    {
        if($exeedingMinutes == 0)
            return false;
        $pricePerMinute = $this->pricePerMinute;
        $increasedValue = 0;
        while($exeedingMinutes > 0){
            $increasedValue = $increasedValue + PercentageHandler::increaseValueByPercentage($pricePerMinute, $increasedPercentagePerMinute);
            $exeedingMinutes--;
        }
        return round($increasedValue, 2);
    }

    public function generateHtmlListOfDddCodesValue()
    {
        $dddCodesValues = $this->getAllDDDCodesOrderedByOrigin();
        if($dddCodesValues->count() == 0)
            return null;
        $attributesToHide = ['id', 'pricePerMinute', 'identificator', 'created_at', 'updated_at'];
        foreach($dddCodesValues as $dddCodesValue){
            $price = $dddCodesValue->pricePerMinute;
            $dddCodesValue->formatedPrice = PercentageHandler::formatValue($price);
        }
        $tableGeneratorObj = new TableGenerator($dddCodesValues);
        $tableGeneratorObj->setHidden($attributesToHide);
        $columnTranslation = [
            'origin'         => 'DDD de Origin',
            'destination'    => 'DDD de Destino',
            'formatedPrice'  => 'Preço por minuto'
        ];
        $tableGeneratorObj->setHeaderTranslation($columnTranslation);
        return $tableGeneratorObj->getTableHtml();
    }
}
