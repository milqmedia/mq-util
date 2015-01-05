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

        $this->autoCompileLess($lessFile, $outputDir . '/' . $cssFile);
         
        $cssPath = $this->config['publicPath'] . '/' . $cssFile;
                      
        return $cssPath . '?' . $filetime;
    }
    
    private function autoCompileLess($inputFile, $outputFile) {

		$importDirs = $this->config['import'];
		$cacheFile = $inputFile . ".cache";

		if (file_exists($cacheFile)) {
			$cache = unserialize(file_get_contents($cacheFile));
		} else {
			$cache = $inputFile;
		}

		$this->less->setImportDir($importDirs);
		
		$newCache = $this->less->cachedCompile($cache);
		
		if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
			file_put_contents($cacheFile, serialize($newCache));
			file_put_contents($outputFile, $newCache['compiled']);
		}
	}
}