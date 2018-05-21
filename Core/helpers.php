<?php

use Config\App;
use Core\Request;
use Core\Session;

if (!function_exists('asset')) {
    function asset($url) {
        try {
            $url = 'http://' . Request::getInstance()->server('SERVER_NAME') . DIRECTORY_SEPARATOR . App::$base_url . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $url;
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $url;
    }
}

if (!function_exists('assetByUrl')) {
     function assetByUrl($url) {
         try {
             $url = 'http://' . Request::getInstance()->server('SERVER_NAME') . DIRECTORY_SEPARATOR . $url;
         } catch (Exception $e) {
             return $e->getMessage();
         }

         return $url;
     }
}

if (!function_exists('authUsername')) {
    function authUsername() {
        try {
            return Session::getInstance()->get('user');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    } 
}

if (!function_exists('authCheck')) {
    function authCheck() {
        return Session::getInstance()->check('user');
    }
}

if (!function_exists('getUri')) {
    function getUri() {
        try {
            return Request::getInstance()->server('REQUEST_URI');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

if (!function_exists('url')) {
    function url($url) {
        return App::$base_url . $url;
    }
}
