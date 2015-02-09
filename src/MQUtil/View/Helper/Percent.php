<?php
  
namespace MQUtil\View\Helper;  

use Zend\View\Helper\AbstractHelper;  

class Percent extends AbstractHelper
{  	   
    public function __invoke($total, $count, $reverse = false)  
    {
    	if($total == 0)
    		return 0;
    		
    	$percent = round(($count / $total) * 100);
    	
    	if($reverse) 
    		$percent = 100 - $percent;
    		
    	return $percent;
    }
}  