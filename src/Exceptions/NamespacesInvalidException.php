<?php

namespace Tohuma\Laravel\Routes\Exceptions;

use RuntimeException;

class NamespacesInvalidException extends RuntimeException 
{
    /**
     * Constructor.
     *
     * @param string    $message
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {

        parent::__construct($message, $code, $previous);
    }
}
