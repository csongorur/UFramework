<?php

namespace Core;

/**
 * Request object
 */
class Request
{
    private $get;
    private $post;
    private $server;
    private static $instance = null;

    private function __construct($get , $post, $server)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
    }

    /**
     * Init request object.
     * @param  array $get
     * @param  array $post
     * @param  array $server
     * @return Request
     */
    public static function init($get, $post, $server)
    {
        if (is_null(self::$instance)) {
            self::$instance = new Request($get, $post, $server);
        }

        return self::$instance;
    }

    /**
     * Get the request instance.
     * @return Request
     * @throws \Exception
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            throw new \Exception("Instance is null!", 1);
        }

        return self::$instance;
    }

    /**
     * Throw exception when name is empty.
     * @param  string $name
     * @throws \Exception
     */
    private function checkName($name = '')
    {
        if ($name == '') {
            throw new \Exception("Name is empty!", 1);
        }
    }

    /**
     * Get the get item by name.
     * @param  string $name
     * @return  mix
     * @throws \Exception
     */
    public function get($name = '')
    {
        $this->checkName($name);

        if (array_key_exists($name, $this->get)) {
            return $this->get[$name];
        } else {
            throw new \Exception("The name not exist!", 1);
        }
    }

    /**
     * Get the post item by name.
     * @param  string $name
     * @return mix
     * @throws \Exception
     */
    public function post($name = '')
    {
        $this->checkName($name);

        if (array_key_exists($name, $this->post)) {
            return $this->post[$name];
        } else {
            throw new \Exception("The name not exist!", 1);
        }
    }

    /**
     * Get the server item by name.
     * @param  string $name
     * @return mix
     * @throws \Exception
     */
    public function server($name = '')
    {
        $this->checkName($name);

        if (array_key_exists($name, $this->server)) {
            return $this->server[$name];
        } else {
            throw new \Exception("The name not exist!", 1);
        }
    }

    /**
     * Check if a item exist in post array by name.
     * @param string $name
     * @return boolean
     * @throws \Exception
     */
    public function hasPost($name = '')
    {
        $this->checkName($name);
        
        return array_key_exists($name, $this->post);
    }

    /**
     * Check if a item exist in get array by name.
     * @param string $name
     * @return boolean
     * @throws \Exception
     */
    public function hasGet($name = '')
    {
        $this->checkName($name);
        
        return array_key_exists($name, $this->get);
    }

    /**
     * Check if a item exist in server array by name.
     * @param string $name
     * @return boolean
     * @throws \Exception
     */
    public function hasServer($name = '')
    {
        $this->checkName($name);
        
        return array_key_exists($name, $this->server);
    }
}
