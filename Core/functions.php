<?php

use Core\Response;
use Core\Session;

function urlIs($url)
{
    return $_SERVER['REQUEST_URI'] === $url;
}

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/$code.php");

    die();
}

function authorize($bool, $status = Response::FORBIDDEN)
{
    if ($bool) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $att = [])
{
    extract($att);
    require base_path('views/' . $path);
}

function redirect($path)
{
    header('location: ' . $path);
    exit();
}

function old($key, $default = '')
{
    return Session::get('old')[$key]?? $default;
}
