<?php 

namespace App;

use Core\Application;


function view($viewAdress, ?array $data = [])
{
    Application::$app->router->view($viewAdress, $data);
}