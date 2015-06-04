mq-util
=======

[![Build Status](https://travis-ci.org/milqmedia/mq-util.svg?branch=master)](https://travis-ci.org/milqmedia/mq-util)

Zend Framework 2 View helpers
- less() to convert LESS files to CSS
- js() to retrieve versioned js files

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
