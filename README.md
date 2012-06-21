README
======

YepsuaSmarTwigBundle
--------------------

Is a set of Twig Tags that allow the creation of jQueryUI widgets in an easy way.

Create RIA (RICH INTERNET APPLICATIONS) with Symfony2 and jQuery4PHP.

Visit the [showcase](http://smartwig.yepsua.com/web/)

# Installation

## For install on Symfony 2.0.x

``` bash
git clone --recursive https://github.com/oyepez003/YepsuaSmarTwigBundle.git vendor/bundles/Yepsua/SmarTwigBundle
```

### For up to date the bundle

``` bash
cd vendor/bundles/Yepsua/SmarTwigBundle
git pull -v --progress  "origin"
git submodule update --init
```

## For install on Symfony 2.1.x

Add the next dependency in the composer.json file

``` yml
"require": {
        ...
        "yepsua/smartwig-bundle": "dev-master",
        ...
    },
```

``` bash
php composer.phar install
```

### For up to date the bundle

``` bash
php composer.phar update
```

# Configuration

### *** Note: If you are using Sf 2.1.x go to step 3

## 1) Add the Yepsua namespace to your autoloader

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    'Yepsua' => __DIR__.'/../vendor/bundles',
    // ...
);
```

## 2) Activate the jQuery4PHP library in your autoloader

Copy the next code at end of file

``` php
<?php
// app/autoload.php
include_once __DIR__.'/../vendor/bundles/Yepsua/SmarTwigBundle/vendor/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php';
YsJQueryAutoloader::register();
```

## 3) Add the YepsuaSmarTwigBundle to your application kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        new Yepsua\SmarTwigBundle\YepsuaSmarTwigBundle(),
        // ...
    );
}
```

## 4) Publishing assets

Run the symfony command

``` bash
$ php app/console assets:install web
```

## 5) Include the SmarTwigBundle assets in your layout

``` html
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>YepsuaSmarTwigBundle</title>

  {% include 'YepsuaSmarTwigBundle::smartwigAssets.html.twig' %}

</head>
<body>
  {% ui_dialog  %}
    Hello World!.
  {% end_ui_dialog %}
</body>
</html>
```


Enjoy

[Showcase](http://smartwig.yepsua.com/web/)
[Twig](http://www.twig-project.org/)
[jQuery4PHP](http://jquery4php.sourceforge.net/)