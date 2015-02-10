<?php

namespace MQUtil\Traits;

trait Geo {
   	
	public function forceDotDecimal($reset = false, $locale = 'nl_NL') {
		
		if($reset === true) {
			
			setlocale(LC_ALL, array($locale . '.UTF-8', $locale . '@euro', $locale));
			return;	
		}

		setlocale(LC_ALL, array('en_US.UTF-8','en_US','en_US','english'));
	}
}