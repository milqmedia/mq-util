<?php
namespace MQLess\View\Helper;

use Zend\View\Helper\AbstractHelper;
use MQLess\Exception\RuntimeException;

class Less extends AbstractHelper
{
	protected $config = array('source' => 'public/less', 'outputPath' => 'public/css', 'publicPath' => 'css');	
	protected $less;
	
	public function __construct(\lessc $less, $config = array()) {
		
		$this->less = $less;
		
		if(!empty($config)) {
			foreach($config as $key => $val) 
				$this->config[$key] = $val;
		}
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