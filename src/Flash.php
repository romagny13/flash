<?php

namespace MicroPHP\Flash;

class Flash
{
    protected $types = [
        'success' => 'success',
        'warning' => 'warning',
        'error' => 'error'
    ];

    protected $storage;

    public function __construct(StorageInterface $storage = null)
    {
        $this->storage = isset($storage) ? $storage : new FlashSessionStorage();
    }

    public function has($type){
        return $this->storage->has($type);
    }

    public function hasSuccess(){
        return $this->has($this->types['success']);
    }

    public function hasWarning(){
        return $this->has($this->types['warning']);
    }

    public function hasError(){
        return $this->has($this->types['error']);
    }
    
    public function create($type){
        $this->storage->create($type);
    }

    public function delete($type){
        return $this->storage->delete($type);
    }

    public function addMessage($type, $message){
        $this->storage->add($type,$message);
        return $this;
    }

    public function addSuccess($message){
       return $this->addMessage($this->types['success'], $message);
    }

    public function addWarning($message){
       return $this->addMessage($this->types['warning'], $message);
    }

    public function addError($message){
       return $this->addMessage($this->types['error'], $message);
    }

    public function getMessages($type){
       return $this->storage->get($type);
    }

    public function getSuccessMessages(){
        return $this->getMessages($this->types['success']);
    }

    public function getWarningMessages(){
        return $this->getMessages($this->types['warning']);
    }

    public function getErrorMessages(){
        return $this->getMessages($this->types['error']);
    }
    
    public function getMessage($type){
        $result = $this->storage->get($type);
        if(is_array($result)){
            return $result[0];
        }
        return null;
    }

    public function getSuccess(){
        return $this->getMessage($this->types['success']);
    }

    public function getWarning(){
        return $this->getMessage($this->types['warning']);
    }

    public function getError(){
        return $this->getMessage($this->types['error']);
    }

}