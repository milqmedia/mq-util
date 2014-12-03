<?php


$config = array(
			'mq_util' => array(
				'less' => array(
					'source' => 'assets/less', 
					'outputPath' => 'public/assets/css', 
					'publicPath' => 'assets/css'
				),
				'js' => array(
					'assetsConfigPath' => __DIR__ . '/../../../../public/assets'
				),
			)
		);
		
return $config;		