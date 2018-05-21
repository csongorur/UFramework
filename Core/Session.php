<?php

namespace Core;

/**
 * Session object.
 * @author ur
 */
class Session
{
    private $session;
    public static $instance = null;
    
    private function __construct(array $session)
    {
        $this->session = $session;
    }
    
    /**
     * Init the session object.
     * @return Session
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Session($_SESSION);
        }
        
        return self::$instance;
    }
    
    /**
     * Get a item from session array by key.
     * @param string $key
     * @return string
     * @throws \Exception
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->session)) {
            return $this->session[$key];
        } else {
            throw new \Exception('Key not exist!', 1);
        }
    }
    
    /**
     * Add a item to the session array.
     * @param string $key
     * @param string $value
     * @return Session
     */
    public function add($key, $value)
    {
        $this->session[$key] = $value;
        $_SESSION[$key] = $value;
        
        return self::$instance;
    }
    
    /**
     * Remove a session item by key.
     * @param string $key
     * @return Session
     */
    public function remove($key)
    {
        unset($this->session[$key]);
        unset($_SESSION[$key]);
        
        return self::$instance;
    }
    
    /**
     * Check if a key exist in session array.
     * @param string $key
     * @return boolean
     */
    public function check($key)
    {
       return array_key_exists($key, $this->session);
    }
}
