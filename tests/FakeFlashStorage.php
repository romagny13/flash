<?php


class FakeFlashStorage implements \MicroPHP\Flash\StorageInterface
{
    private $storage;
    
    public function __construct()
    {
        $this->storage = [];
    }

    public function has($type){
        return isset($this->storage[$type]);
    }

    public function create($type){
        $this->storage[$type] = [];
    }

    public function delete($type){
        if($this->has($type)) {
            unset($this->storage[$type]);
            return true;
        }
        return false;
    }
    
    public function add($type, $message){
        if(!$this->has($type)){
            $this->create($type);
        }
        array_push($this->storage[$type], $message);
    }
    
    public function get($type){
        if($this->has($type)){
            $result = $this->storage[$type];
            $this->delete($type);
            return $result;
        }
        return null;
    }
    
}