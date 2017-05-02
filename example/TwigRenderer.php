<?php

class TwigRenderer
{
    public $twig;

    public function __construct($templateDirectory)
    {
        $loader = new Twig_Loader_Filesystem($templateDirectory);
        $this->twig = new Twig_Environment($loader);
    }

    public function render($viewPath, $params=[]){
        echo $this->twig->render($viewPath,$params);
    }
}