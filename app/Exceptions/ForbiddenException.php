<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    public function __construct()
    {
        $this->message = "Sunucuya haddinizi ve yetkinizi aşan bir istek yaptığınız ve yakalandığınız
        anlamına geliyor. Çok ufakta olsa murphy kuralları gereği yanlış alarm da olabilir ancak
        orayı çok da şey edemeyeceğiz. Bu saatteb sonra sizi ancak loglar paklar.";
        $this->code = 403;
    }

}
