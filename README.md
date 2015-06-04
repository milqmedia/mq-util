mq-util [![Build Status](https://travis-ci.org/milqmedia/mq-util.svg?branch=master)](https://travis-ci.org/milqmedia/mq-util)
=======

Basic utillities used in ZF2 controller and views.

**Zend Framework 2 View helpers**
- less() to convert LESS files to CSS
- js() to retrieve versioned js files

**MQUtil\Collector\Milq**
ZendDeveloperTools collector listing environment, timezone and defaultlocale

**MQUtil\Log\Writer\Doctrine**
Doctrine log writer

## Installation

  1. Run `php composer.phar require milqmedia/mq-util:dev-master`
  2. Add `MQUtil ` to the enabled modules list
  3. Use the less or js viewhelper in your template

## Usage

**View helpers**

```html
<!DOCTYPE html>					
<html>
<head>
<title>MQUtil</title>
{$this->headLink()->setStylesheet($this->basePath($this->less('less/site.less')))}
{$this->headScript()->setFile({$this->basePath($this->js('jquery'))})}
</head>
<body>
Hello World
</body>
</html>
```

**MQUtil\Collector\Milq**

ZendDeveloperTools collector listing environment, timezone and defaultlocale

**MQUtil\Log\Writer\Doctrine**

Doctrine log writer
