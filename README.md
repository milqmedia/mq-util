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

**MQUtil\Service\ShortUrl**

Url shortner using the Google urlshortener API.

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

Add the collector to the zdt config file

```
array(
    'zenddevelopertools' => array(
        'profiler' => array(
            'collectors' => array('milq' => 'MQUtil\Collector\Milq'),
        ),
    )
```

And a template to the toolbar

```
array(
    'zenddevelopertools' => array(
        'toolbar' => array(
          'entries'       => array(
	          'milq' => 'zend-developer-tools/toolbar/milq',
	        ),
	      )
	   )
)
```

**MQUtil\Log\Writer\Doctrine**

Copy the ```Log.php.dist``` file from the package root to your entity directory. Change the namespace if necessary.

Use it like this: 
```
$this->getServiceLocator()->get('Zend\Log\Logger')->err("error")
```

**MQUtil\Service\ShortUrl**

Configure your Google API Key:

```
return array(
	'google_short_url' => array(
		'apiKey' => '<key>',
	)
);
```

Use it like this:
```
$shortUrlApi = $this->getServiceLocator()->get('MQUtil\Service\ShortUrl');
$response = $shortUrlApi->shortenUrl('http://google.com');
```

If successful, the response will look like:
```
{
 "kind": "urlshortener#url",
 "id": "http://goo.gl/fbsS",
 "longUrl": "http://www.google.com/"
}
```

## Development

...

## Contributing

1. Fork it ( https://github.com/milqmedia/mq-util/fork )
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create a new Pull Request
