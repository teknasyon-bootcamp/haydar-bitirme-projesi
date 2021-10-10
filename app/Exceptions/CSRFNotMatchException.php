<?php 

namespace App\Exceptions;

use Exception;

class CSRFNotMatchException extends Exception
{
    public function __construct()
    {
        $this->message = "Erişim jetonları eşleşmedi! Yolladığınız isteği geçersiz bir erişim jetonu tespit ettik.";
        $this->code = 419;
    }   
}