<?php

require __DIR__.'/../vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$flash = new \MicroPHP\Flash\Flash();
$flash
    ->addMessage('success','<strong>Success!</strong> <i>Message 1</i>')
    ->addSuccess('Success message 2')
    ->addMessage('warning','Warning message 1')
    ->addWarning('Warning message 2')
    ->addMessage('error','Error message 1')
    ->addError('Error message 2')
    ->addMessage('notification','My notification');


header('Location:http://localhost:8080/');