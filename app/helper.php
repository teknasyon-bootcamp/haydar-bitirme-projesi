<?php


use Core\Application;
use Core\Session;
use App\Models\User;

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
function env($key): string
{
    return parse_ini_file(AppRootDirectory . "/.env")[$key];
}

/**
 * Return route path
 * 
 */
function route(string $name)
{
    $routes = Application::$app->router->routes;

    foreach ($routes['get'] as $key => $route) {
        $routeName = $route->name ?? null;

        $siteSchema = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];

        if ($routeName === $name) {
            return $siteSchema . $route->path;
        } 
    }
    
    throw new Exception("Route name not found", 1);
    
}

function user()
{
    $user = User::find(Session::get('user_id'));

    return $user;
}

function isGuest()
{
    return empty(Session::get('user_id'));
}
