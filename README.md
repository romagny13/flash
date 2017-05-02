# Flash

* [MicroPHP](https://github.com/romagny13/micro-php)

## Installation

```
composer require romagny13/flash
```

## How To run the example

Example with Twig, Bootstrap 3, Animate.css and Toastr

```
composer install
composer start
```

Go http://localhost:8080/

## Usage

Example: add messages

```php
$flash = new \MicroPHP\Flash\Flash();
$flash
    ->addMessage('success','<strong>Success!</strong> <i>Message 1</i>')
    ->addSuccess('Success message 2')
    ->addMessage('warning','Warning message 1')
    ->addWarning('Warning message 2')
    ->addMessage('error','Error message 1')
    ->addError('Error message 2')
    ->addMessage('notification','My notification');
```

Check if has message

```php
$hasSuccessMessages = $flash->hasSuccess();
$hasSuccessMessages = $flash->hasWarning();
$hasSuccessMessages = $flash->hasError();
$hasMessages = $flash->has('notification');
```

get the messages with

```php
$successMessages = $flash->getSuccessMessages();
$warningMessages = $flash->getWarningMessages();
$errorMessages = $flash->getErrorMessages();
$myMessages = $flash->getMessages('notification');
```

Get only the first message

```php
$successMessage = $flash->getSuccess();
$warningMessage = $flash->getWarning();
$errorMessage = $flash->getError();
$myMessage = $flash->getMessage('notification');
```

### With Twig 1.0

[Documentation](https://twig.sensiolabs.org/doc/1.x/)

_Note:_ **Twig 2.0** require **PHP 7**


Install **Twig**

```
composer require twig/twig:~1.0
```


Render with Twig_Loader_Filesystem

```php
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
```

Create a renderer with the templates directory path
Create a global variable with the flash instance and render the page.

```php
$renderer = new TwigRenderer(__DIR__.'/templates');

$renderer->twig->addGlobal('flash', $flash);

$renderer->render('home.twig');
```

In the view (a partial for example)

```xml
{% if flash.hasSuccess() %}
    <div class="alert alert-success">
        {{ flash.getSuccess() }}
    </div>
{% endif %}

{% if flash.has('error') %}
    <div class="alert alert-danger">
        {{ flash.getMessage('error') }}
    </div>
{% endif %}
```

Or with multiple messages for example

```xml
{% if flash.has('success') %}
    {% for message in flash.getMessages('success') %}
        <div class="alert alert-success fadeIn animated">
            {{ message }}
        </div>
    {% endfor %}
{% endif %}
```