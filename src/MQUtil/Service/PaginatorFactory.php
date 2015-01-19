<?php
	
namespace MQUtil\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use MQUtil\Service\Paginator;

class PaginatorFactory implements FactoryInterface
{	
	public function createService(ServiceLocatorInterface $serviceLocator)
    {
	    $paginator = new Paginator();
		
		return $paginator;
	}
}