<?php

namespace Core;

class Request
{
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

    // 
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
    public function getBody()
    {
        $data = $_REQUEST;
        return $data;
    }

    /**
     * Return request parameter if someone try access undefined property
     * 
     * @param string $name
     * @return Request $property 
     */
    public function __get($name)
    {       
        $bodyData = $this->getBody();

        if (array_key_exists($name, $bodyData)) {
            return $bodyData[$name];
        }
    }

}
