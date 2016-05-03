<?php

namespace Tohuma\Laravel\Routes\Exceptions;

use Exception;

class RouteFileNotFoundException extends Exception 
{

    /**
     * Constructor.
     *
     * @param string    $filename
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($filename, $code = 0, Exception $previous = null)
    {

        parent::__construct("The config file {$filename} no exists.", $code, $previous);
    }

}
