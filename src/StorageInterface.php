<?php

namespace MicroPHP\Flash;

interface StorageInterface
{
    public function add($key, $value);
    public function has($key);
    public function get($key);
    public function delete($key);
}

