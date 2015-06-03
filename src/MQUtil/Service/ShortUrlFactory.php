<?php
	
namespace MQUtil\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use MQUtil\Service\ShortUrl;

class ShortUrlFactory implements FactoryInterface
{	
	public function createService(ServiceLocatorInterface $serviceLocator)
    {
	    $config 		= $serviceLocator->get('config');

		if(!isset($config['google_short_url']['apiKey']))
			throw new \MQUtil\Exception\RuntimeException('Url Shortener: No google api key configured. Can not do stuff without one.');
			
	    $shortUrl = new ShortUrl($config['google_short_url']['apiKey']);
		
		return $shortUrl;
	}
}