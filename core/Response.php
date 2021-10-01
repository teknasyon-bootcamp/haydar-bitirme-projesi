<?php 

namespace Core;

class Response
{
    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header("Location: $url");
    }
}