<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Talep ettiğiniz kaynak sunucuda bulunamadı";
        $this->code = 404;
    }

}
