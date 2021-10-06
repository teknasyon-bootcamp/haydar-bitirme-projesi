<?php

namespace Core;

class Request extends Validation
{
    public function __construct()
    {  
        $this->getParams();
    }

    /**
     * Get path from $_SERVER['REQUEST_URI'] global variable
     * 
     * @return string $path
     */
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


    /**
     * Get path from $_SERVER['REQUEST_METHOD'] global variable
     * 
     * @return string $method
     */
    public function getMethod()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        return $method;
    }

    /**
     * Reads params from request
     * 
     * @return Array $data
     */
    public function getParams()
    {
        $data = $_REQUEST;

        foreach ($data as $key => $value) {
            $this->$key = $value;
        }        
    }

    /**
     * Return all params from request
     * 
     * @return Array $data
     */
    public function all()
    {
        return $this->getParams();
    }
}
