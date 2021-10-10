<?php

namespace App\Exceptions;

use Exception;

class NoFoundError extends Exception
{
    public function __construct()
    {
        $this->message = "Talep ettiğiniz kaynak sunucuda bulunamadı";
        $this->code = 404;
    }

}
