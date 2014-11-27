<?php
namespace MQLess;
 
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use MQLess\View\Helper\Less;

class Module
{	    
	const SERVICE_NAME = 'lessc';
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );        
    }
 
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {	    
	    $app    = $e->getApplication();
	    $less 	= new \lessc();
	
        $app->getServiceManager()->setService(self::SERVICE_NAME, $less);
    }

    public function getViewHelperConfig()
    {
        $lessClosure = function ($sm) {
            $locator = $sm->getServiceLocator();
            $config = $locator->get('Config');
            
            $lessConfig = (!empty($config['mqless'])) ? $config['mqless'] : [];
            
            return new Less($locator->get(self::SERVICE_NAME), $lessConfig);
        };
        return array(
            'factories' => array(
                'less' => $lessClosure,
            ),
        );
    }
}