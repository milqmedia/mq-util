mq-util
=======

[![Build Status](https://travis-ci.org/milqmedia/mq-util.svg?branch=master)](https://travis-ci.org/milqmedia/mq-util)

## Zend Framework 2 Viewhelpers
- LESS: to convert LESS files to CSS
- JS: Fetch versioned js files 

## Setup

  1. Run `php composer.phar require milqmedia/mq-less:dev-master`
  2. Add `MQLess` to the enabled modules list
  3. Use the Less viewhelper to convert your LESS files or the JS viewhelper to get your versioned JS files

    ```html
<!DOCTYPE html>					
<html>
<head>
<title>MQLess</title>
{$this->headScript()->setFile($this->basePath($this->js('myJS')), 'text/javascript')}
{$this->headLink()->setStylesheet($this->basePath($this->less('less/site.less')))}
</head>
<body>
	{$this->content}
</body>
</html>
    ```
