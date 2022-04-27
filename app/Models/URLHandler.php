<?php

namespace App\Models;

use Throwable;

class URLHandler
{
    /**
     * Return generated web link according to sent $path and enviroment variable at ENV['APP_ENV']
     *
     * @param  string the route to generate the web link
     * @return string the generated web link
     */
    public static function viewLink($path)
    {
        try {
            if(env('APP_ENV') == 'local'){
               return url($path);
            }else{
                return secure_url($path);
            }
        } catch (Throwable $th) {
            abort(404);
        }
    }
}