<?php

namespace Core;

/**
* View controller
*/
class View
{
    private $data;
    private $file;
            
    function __construct($view_name)
    {
        $this->file = ROOT . 'View/' . strtolower($view_name) . '.php';
        $this->data = [];
    }
    
    public function render()
    {
        ob_start();
        extract($this->data);
        include($this->file);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function assign($data)
    {
        $this->data = $data;
    }
}
