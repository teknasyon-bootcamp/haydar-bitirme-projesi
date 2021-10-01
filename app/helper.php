<?php 

namespace App;

use Core\Application;


function view($viewAdress, ?array $data = [])
{
    return Application::$app->router->view($viewAdress, $data);
}