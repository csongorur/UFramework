<?php

use Config\App;
use Core\Request;
use Core\Session;

if (!function_exists('asset')) {
    function asset($url) {
        $url = 'http://' . Request::getInstance()->server('SERVER_NAME') . DIRECTORY_SEPARATOR . App::$base_url . DIRECTORY_SEPARATOR . 'public'. DIRECTORY_SEPARATOR . $url;
        return $url;
    }
}

if (!function_exists('assetByUrl')) {
     function assetByUrl(string $url) {
         $url = 'http://' . Request::getInstance()->server('SERVER_NAME') . DIRECTORY_SEPARATOR . $url;
        return $url;
     }
}

if (!function_exists('authUsername')) {
    function authUsername() {
        return Session::getInstance()->get('user');
    } 
}

if (!function_exists('authCheck')) {
    function authCheck() {
        return Session::getInstance()->check('user');
    }
}

if (!function_exists('getUri')) {
    function getUri() {
        return Request::getInstance()->server('REQUEST_URI');
    }
}

if (!function_exists('url')) {
    function url(string $url) {
        return App::$base_url . $url;
    }
}
