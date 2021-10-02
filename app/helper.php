<?php 


use Core\Application;


function view($viewAdress, ?array $data = [])
{
    return Application::$app->view->render($viewAdress, $data);
}

function publicPath(?string $path = null)
{
    $dd = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']."/$path"; 
    return $dd;
}