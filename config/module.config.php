<?php


$config = array(
	'mq_util' => array(
		'less' => array(
			'source' 				=> 'assets/less', 
			'import' 				=> array(),
			'outputPath' 			=> 'public/assets/css', 
			'publicPath' 			=> 'assets/css',
			'reCompileLess' 		=> true,
		),
		'js' => array(
			'assetsConfigPath' => __DIR__ . '/../../../../public/assets'
		),
	),
	'view_helpers' => array(  
        'invokables' => array(  
            'dateFormat' => 'MQUtil\View\Helper\DateFormat',
            'percent' => 'MQUtil\View\Helper\Percent',
        ),
    ),
	'service_manager' => array(
		'invokables' => array(
			'MQUtil\Collector\Milq' => 'MQUtil\Collector\Milq',
		),
		'factories'  => array(
			'MQUtil\Service\ShortUrl' => 'MQUtil\Service\ShortUrlFactory',
            'MQUtil\Service\Paginator' => 'MQUtil\Service\PaginatorFactory',
            'Zend\Log\Logger' => function($sm){
                
                $logger = new Zend\Log\Logger;
                $writer = new MQUtil\Log\Writer\Doctrine($sm->get('doctrine.entitymanager.orm_default'));
                 
                $logger->addWriter($writer);  
                 
                return $logger;
            },
        ),
	),
	'view_manager' => array(
	    'template_map' => array(
		    'zend-developer-tools/toolbar/milq' => __DIR__ . '/../view/zend-developer-tools/toolbar/milq.phtml'
		),
	),
	'google_short_url' => array(
		'apiKey' => getenv('GOOGLE_SHORT_URL_API_KEY'),
	),
);
		
return $config;		