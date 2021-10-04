<?php


use Core\Application;


function view($viewAdress, ?array $data = [])
{
    return Application::$app->view->render($viewAdress, $data);
}

function publicPath(?string $path = null)
{
    $dd = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/$path";
    return $dd;
}

function dd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";

    die;
}

function redirect($url)
{
    return Application::$app->response->redirect($url);
}

function setStatusCode(int $statusCode)
{
    Application::$app->response->statusCode($statusCode);
}

function back()
{
    redirect(Application::$app->router->backUrl);
}
