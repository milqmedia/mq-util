mq-less
=======

ZF2 Viewhelper to convert LESS files to CSS

## Setup

  1. Run `php composer.phar require milqmedia/mq-less:dev-master`
  2. Add `MQLess` to the enabled modules list
  3. Use the Less viewhelper to convert your LESS files

    ```html
<!DOCTYPE html>					
<html>
<head>
<title>MQLess</title>
{$this->headLink()->setStylesheet($this->basePath($this->less('less/application.less')))}
</head>
<body>
	{$this->content}
</body>
</html>
    ```
