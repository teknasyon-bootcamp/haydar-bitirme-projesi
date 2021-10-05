<?php


use Core\Application;


function view($viewAdress, ?array $data = [])
{
    return Application::$app->view->render($viewAdress, $data);
}

function publicPath(?string $path = null)
{
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/$path";
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

/**
 * Returns last initialised view
 */
function back()
{
    redirect(Application::$app->router->backUrl);
}

/**
 * Get environment variables
 */
function env($key) : string
{
    return parse_ini_file(AppRootDirectory."/.env")[$key];
}
