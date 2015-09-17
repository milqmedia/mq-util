<?php

namespace MQUtil\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Http\Client as HttpClient;

class Cache extends AbstractPlugin
{
    public function setMaxAge($maxAge = 0)
    {
    	if(defined('FORCE_REFRESH') || defined('NGINX_CACHE_OFF'))
    		$maxAge = 0;
		
		if(php_sapi_name() !== 'cli') {
	
			header('Set-Cookie:', true);
			header("Cache-Control: max-age=" . $maxAge, true);
		}
    }

    public function purgeUrl($requestUrl, $params = array()) {
		
		if(LANGUAGE_ID == 3) {
		
			$this->purgeFS(BASE_SCHEME . '//www.' . DOMAIN . $requestUrl);
			
		} else {
		
			$this->purgeFS(BASE_SCHEME . '//www.' . DOMAIN_NL . $requestUrl);	
			$this->purgeFS(BASE_SCHEME . '//www.' . DOMAIN_BE . $requestUrl);	
		}
    }
    
    private function purgeFS($requestUrl, $method = 'GET') {
	    
	    $cache_path = '/var/cache/nginx/';
		$url = parse_url($requestUrl);
		
		if(!$url)
			return false;		    
		
		$scheme = $url['scheme'];
		$host = $url['host'];
		$requesturi = $url['path'];
		$query = (isset($url['query'])) ? $url['query'] : '';
		
		$hash = md5($scheme . $method . $host . $requesturi . $query);

		return @unlink($cache_path . substr($hash, -1) . '/' . substr($hash,-3,2) . '/' . $hash);
    }
}