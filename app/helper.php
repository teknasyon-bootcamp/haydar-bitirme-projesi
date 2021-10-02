<?php 


use Core\Application;


function view($viewAdress, ?array $data = [])
{
    return Application::$app->router->view($viewAdress, $data);
}

function publicPath(?string $path = null)
{
    $dd = $_SERVER['HTTP_HOST']."/$path"; 
    var_dump($dd);
    exit;  
}