<?php
namespace MQUtil\View\Helper;

use Zend\View\Helper\AbstractHelper;
use MQUtil\Exception\RuntimeException;

class Less extends AbstractHelper
{
	protected $config;	
	protected $less;
	
	public function __construct(\lessc $less, $config) {
		
		$this->less = $less;
		
		if(!empty($config)) {
			foreach($config as $key => $val) 
				$this->config[$key] = $val;
		}

		if(!file_exists($this->config['source']))
			mkdir($this->config['source'], 0755, true);
			
		if(!file_exists($this->config['outputPath']))
			mkdir($this->config['outputPath'], 0755, true);
	}
	
    public function __invoke($file)
    {   	
		$sourceDir = $this->config['source'];
		$outputDir = $this->config['outputPath'];
		$info = pathinfo($file);

        if (!is_file($sourceDir . '/' . $file)) {
           throw new RuntimeException('No LESS file found @ ' . $sourceDir . '/' . $file);
        }        
        
        $cssFile = $info['filename'] . '.css';
        $lessFile = $sourceDir . '/' . $file;
        $filetime = filemtime($sourceDir . '/' . $file);     

        $this->less->checkedCompile($lessFile, $outputDir . '/' . $cssFile);
         
        $cssPath = $this->config['publicPath'] . '/' . $cssFile;
                      
        return $cssPath . '?' . $filetime;
    }
}