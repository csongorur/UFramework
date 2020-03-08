<?php

namespace Route;

class Web
{
    public static function getRoutes()
    {
        return [
            '/' => ['ExampleController' => 'index'],
        ];
    }
}
