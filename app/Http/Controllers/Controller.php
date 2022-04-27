<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct(Request $request) {
        $this->request = $request;
        $this->session = session();
    }
    
    /**
     * Returns all session data
     *
     * @return array
     */
    function getSessionData()
    {
        return $this->request->session()->all();
    }

    /**
     * Returns all parameters of $this \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Request  $request value
     */
    function getParameters()
    {
        return $this->request->all();
    }

    /**
     * Returns the value of $this \Illuminate\Http\Request  $request accordingly to $parameterName sent. In case selected $request variable is null sets 
     * $request value as the $defaultValue which is <null> by default
     *
     * @param  string (the $request parameter name to get the value from) - required
     * @param  string (the default value to put on return of this $request chosen variable)
     * @return \Illuminate\Http\Request  $request value
     */
    function getParameter($parameterName, $defaultValue = null)
    {
        if(is_null($this->request->{$parameterName})){
            $this->setParameter($parameterName, $defaultValue);
        }
        return $this->request->{$parameterName};
    }

    /**
     * Sets the value of $this \Illuminate\Http\Request  $request accordingly to $parameterName sent. In case sent $defaultValue is null sets 
     * $request value as the $defaultValue which is <null> by default
     *
     * @param  string (the $request parameter name to set the value) - required
     * @param  string (the value to put in $this $request variable)
     * @return \Illuminate\Http\Request  $request value
     */
    function setParameter($parameterName, $defaultValue = null)
    {
        $this->request->merge([$parameterName => $defaultValue]);
    }
}