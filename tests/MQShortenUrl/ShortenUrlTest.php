<?php
/**
 * MQUtil
 * Copyright (c) 2015 Milq Media.
 *
 * @author      Johan Kuijt <johan@milq.nl>
 * @copyright   2015 Milq Media.
 * @license     http://www.opensource.org/licenses/mit-license.php  MIT License
 * @link        http://milq.nl
 */
 
use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceManager;
use MQUtil\Module;

class ShortenUrlTest extends TestCase
{
    public function setUp()
    {
	    putenv('GOOGLE_SHORT_URL_API_KEY=AIzaSyBw3EKWlHl2fY0lqYRoravDnpWPXnfDvao');
    }

    public function testShortenUrlsWorks()
    {
	    $config = array(
		    'google_short_url' => array(
	            'apiKey'	=> getenv('GOOGLE_SHORT_URL_API_KEY'),
	        )
	    );
	    
	    $sl = $this->getServiceLocator($config);
	    $shortUrlService = $sl->get('MQUtil\Service\ShortUrl');
	    
	    $response = $shortUrlService->shortenUrl('http://www.google.nl');
	    
        $this->assertEquals($response->kind, 'urlshortener#url');
    }
    
    public function getServiceLocator(array $config = array())
    {        
        $serviceLocator = new ServiceManager;
        $serviceLocator->setFactory('MQUtil\Service\ShortUrl', 'MQUtil\Service\ShortUrlFactory');
        $serviceLocator->setService('config', $config);

        return $serviceLocator;
    }
}