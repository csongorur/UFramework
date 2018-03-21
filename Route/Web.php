<?php

namespace Route;

class Web
{
    public static function getRoutes()
    {
        return [
            '/' => ['ExempleController' => 'index'],
        ];
    }
}
