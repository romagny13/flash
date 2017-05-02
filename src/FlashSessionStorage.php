<?php

namespace MicroPHP\Flash;

class FlashSessionStorage implements StorageInterface
{
    public function create($type){
        $_SESSION[$type] = [];
    }
    
    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function get($key)
    {
        if($this->has($key)){
            $result = $_SESSION[$key];
            $this->delete($key);
            return $result;
        }
        return null;
    }

    public function add($key, $value)
    {
        if(!$this->has($key)){
            $this->create($key);
        }
        array_push($_SESSION[$key], $value);
    }

    public function delete($key)
    {
        if($this->has($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
}
