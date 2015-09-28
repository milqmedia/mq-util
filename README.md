mq-util [![Build Status](https://travis-ci.org/milqmedia/mq-util.svg?branch=master)](https://travis-ci.org/milqmedia/mq-util)
=======

Basic utillities used in ZF2 controller and views.

**Zend Framework 2 View helpers**
- less() to convert LESS files to CSS
- js() to retrieve versioned js files
- dateFormat() to format dates in different, many used, formats
- percent() to quickly calculate a percentage

**MQUtil\Collector\Milq**

ZendDeveloperTools collector listing environment, timezone and defaultlocale

**MQUtil\Log\Writer\Doctrine**

Doctrine log writer

**MQUtil\Service\ShortUrl**

Url shortner using the Google urlshortener API.

**MQUtil\Service\Paginator**

Super simple and easy to use pagination class

**MQUtil\Service\Iterator**

Super simple and easy to use iteration class with prevItem support

## Installation

  1. Run `php composer.phar require milqmedia/mq-util:dev-master`
  2. Add `MQUtil ` to the enabled modules list
  3. Use the less or js viewhelper in your template

## Usage

**Less & JS helpers**

```
$this->headLink()->setStylesheet($this->basePath($this->less('less/site.less')))
$this->headScript()->setFile({$this->basePath($this->js('jquery')))
```
**Percent view helper**
```
$this->percent($total, $count, $reverse = false);
```
 - **$total**: Total items
 - **$count**: Items to calculate percentage of
 - **$reverse**: Return the remaining percentage instead of the calculated percentage

**DateFormat view helper**
```
$this->dateFormat($date)->dayName();
```
Available methods:
- **forumDate**: Returns "H:i" if today, "d-m H:i" if this year, else "d-m-y H:i"
- **ago**: Returns seconds, minutes, hours, days, etc. ago since given date
- **dayName($short = false)**: Dayname for the given date, if short is true dayname is in a short format e.g. Sun.
- **monthName**: Monthname for the given date

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

**MQUtil\Service\Paginator**

Create a new pagination object:
```
$paginator = $this->getServiceLocator()->get('MQUtil\Service\Paginator')->getPaginator($numberOfItems, $numberOfItemsPerPage, $currentPage);
```
Available methods:
```
$paginator->next();
$paginator->prev();
$paginator->current();
$paginator->total();
$paginator->offsetStart();
$paginator->isLastPage();
```

**MQUtil\Service\Iterator**

Create a new iteration object:
```
$iterator = $this->getServiceLocator()->get('MQUtil\Service\Iterator')->getIterator($array, $currentItem);
```
Available methods:
```
$iterator->hasNext();
$iterator->nextItem();
$iterator->hasPrev();
$iterator->prevItem();
$iterator->currentItem();
$iterator->isLastItem();
```

## Development

...

## Contributing

1. Fork it ( https://github.com/milqmedia/mq-util/fork )
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create a new Pull Request
