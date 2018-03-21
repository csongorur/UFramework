<?php

namespace Core;

use Config\App;
use Exception;
use Route\Web;

class Route
{
    public static function execute(string $uri = null)
    {
        $routes = Web::getRoutes();

        $uri = str_replace(App::$base_url, '', $uri);
        
        if (array_key_exists($uri, $routes)) {
            $route = $routes[$uri];

            $class_name = key($route);
            $function_name = $route[key($route)];

            $class = 'Controller\\' . $class_name;

            $instance = new $class();

            return $instance->$function_name();

        } else {
            throw new Exception("Not found! searched url: " . $uri, 1);
        }
    }
}
