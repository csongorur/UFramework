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

    private function __construct(array $get , array $post, array $server)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
    }

    /**
     * Init request object.
     * @param  array  $get
     * @param  array  $post
     * @return Request
     */
    public static function init(array $get, array $post, array $server)
    {
        if (is_null(self::$instance)) {
            self::$instance = new Request($get, $post, $server);
        }

        return self::$instance;
    }

    /**
     * Get the request instance.
     * @return Request
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
     */
    private function checkName(string $name = '')
    {
        if ($name == '') {
            throw new \Exception("Name is empty!", 1);
        }
    }

    /**
     * Get the get item by name.
     * @param  string $name
     * @return  mix
     */
    public function get(string $name = '')
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
     */
    public function post(string $name = '')
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
     */
    public function server(string $name = '')
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
     */
    public function hasPost(string $name = '')
    {
        $this->checkName($name);
        
        return array_key_exists($name, $this->post);
    }
    
    /**
     * Check if a item exist in get array by name.
     * @param string $name
     * @return boolean
     */
    public function hasGet(string $name = '')
    {
        $this->checkName($name);
        
        return array_key_exists($name, $this->get);
    }
    
    /**
     * Check if a item exist in server array by name.
     * @param string $name
     * @return boolean
     */
    public function hasServer(string $name = '')
    {
        $this->checkName($name);
        
        return array_key_exists($name, $this->server);
    }
}
