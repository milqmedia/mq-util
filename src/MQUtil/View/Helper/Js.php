<?php
namespace MQUtil\View\Helper;

use Zend\View\Helper\AbstractHelper;
use MQUtil\Exception\RuntimeException;

class Js extends AbstractHelper
{
	protected $assets;	
	protected $less;
	
	public function __construct($config) {

		$this->config = $config;

		if(!file_exists($this->config['assetsConfigPath']))
			throw new RuntimeException('Assets config file not found');
			
		$string = file_get_contents($this->config['assetsConfigPath'] . "/assets.config.json");
		$assetsConfig = json_decode($string);

		$this->assets = $assetsConfig->staticAssets;
	}
	
    public function __invoke($assetName)
	{
		$array = $this->assets->{$assetName}->js;
		
		if(!is_array($array))
			return null;
			
		return '/assets' . current($this->assets->{$assetName}->js);
    }
}