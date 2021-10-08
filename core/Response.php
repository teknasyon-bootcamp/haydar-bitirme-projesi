<?php

namespace Core;

class Response
{
    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url,  ?bool $noRoot = false)
    {
        $site = '';

        if ($noRoot) {
            $site = $url;
        } else {
            $site = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "$url";
        }

        header("Location: " . $site);
        exit;
    }
}
