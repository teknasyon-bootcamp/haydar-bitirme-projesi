<?php

namespace Core;

class Request
{


    // Get path from $_SERVER['REQUEST_URI'] global variable
    public function getPath()
    {
        //Path is home if REQUEST_URI is null
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        // That means no any params. 
        if ($position === false) {
            return $path;
        }

        // Seperates path from REQUEST_URI
        return substr($path, 0, $position);
    }

    // Get path from $_SERVER['REQUEST_METHOD'] global variable
    public function getMethod()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        return $method;
    }

    public function getBody()
    {
        $data = $_REQUEST;
        return $data;
    }

    public function __get($name)
    {       
        $bodyData = $this->getBody();

        if (array_key_exists($name, $bodyData)) {
            return $bodyData[$name];
        }
    }

}
