<?php
namespace MQLess\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Stdlib\Glob;

class Less extends AbstractHelper
{
	const PUBLIC_DIR = 'public/';
	const DESTINATION_DIR = 'css/';
	
    public function __invoke($file, $minify = null)
    {   	
        if (!is_file(self::PUBLIC_DIR . $file)) {
           return false;
        }
        
        $less = new \lessc();
        $info = pathinfo($file);
        $newFile = self::DESTINATION_DIR . $info['filename'] . '.css';
        $filetime = filemtime(self::PUBLIC_DIR . $file);
                        
        $_file = self::PUBLIC_DIR . $newFile;
        
        $less->checkedCompile(self::PUBLIC_DIR . $file, $_file);
                        
        return $newFile . '?' . $filetime;
    }
}