<?php
	
namespace MQUtil\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use MQUtil\Service\Iterator;

class IteratorFactory implements FactoryInterface
{	
	public function createService(ServiceLocatorInterface $serviceLocator)
    {
	    $paginator = new Iterator();
		
		return $paginator;
	}
}