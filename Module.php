<?php
namespace MQUtil;
 
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use MQUtil\View\Helper\Less;

class Module
{	    
	const LESS_SERVICE_NAME = 'lessc';
    
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
	
        $app->getServiceManager()->setService(self::LESS_SERVICE_NAME, $less);
    }

    public function getViewHelperConfig()
    {
        $lessClosure = function ($sm) {
            
            $locator = $sm->getServiceLocator();
            $config = $locator->get('Config');
            
            $lessConfig = (!empty($config['mq_util']['less'])) ? $config['mq_util']['less'] : [];
            
            return new Less($locator->get(self::LESS_SERVICE_NAME), $lessConfig);
        };
        
        return array(
            'factories' => array(
                'less' => $lessClosure,
            ),
        );
    }
}