<?php 

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    public function __construct() 
    {
        $this->message = "Yolladığınız isteği geçersiz bir formdan geldiğini tespit ettik.";
        $this->code = 419;
    }
}