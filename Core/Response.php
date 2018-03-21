<?php

namespace Core;

use Config\App;

/**
 * Response object.
 */
class Response
{
    /**
     * Redirect to another url.
     * @param string $url
     * @return mix
     */
    public static function redirect(string $url)
    {
        return header('Location: '. App::$base_url .$url);
    }
}
