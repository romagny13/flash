<?php

require __DIR__.'/../vendor/autoload.php';

require 'TwigRenderer.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$flash = new \MicroPHP\Flash\Flash();

$renderer = new TwigRenderer(__DIR__.'/templates');

$renderer->twig->addGlobal('flash', $flash);

$renderer->render('home.twig');

// var_dump($_SESSION);