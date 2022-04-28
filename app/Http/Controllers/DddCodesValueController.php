<?php

namespace App\Http\Controllers;

use App\Models\DddCodesValue;

class DddCodesValueController extends Controller
{
    /**
     * Gets a HTML table of all DddCodesValue objects
     *
     * @return json  {
     *                  <bool>   'success' => whether true or  false,
     *                  <string> 'content' => generated table or empty space,
     *               }
     */
    public function listDddCodesValue()
    {
        $dddCodesValueObj  = new DddCodesValue();
        $dddCodesHtmlTable = $dddCodesValueObj->generateHtmlListOfDddCodesValue();
        return json_encode([
            'success' => (is_string($dddCodesHtmlTable) ? true               : false),
            'content' => (is_string($dddCodesHtmlTable) ? $dddCodesHtmlTable : '')
        ]);
    }
}