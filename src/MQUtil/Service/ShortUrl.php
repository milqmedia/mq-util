<?php
	
namespace MQUtil\Service;

use Zend\Http\Client;

class ShortUrl 
{	
	private $apiKey = null;
	
	public function __construct($apiKey) {
		
		$this->apiKey = $apiKey;	
	}
	
	public function shortenUrl($url) {

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key=' . $this->apiKey );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json') );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode(array('longUrl' => $url)) );

		$json = curl_exec($ch);
		curl_close($ch);
  		
		$response = json_decode($json);
		
		if(!isset($response->kind) || $response->kind != 'urlshortener#url') {
			throw new \MQUtil\Exception\RuntimeException('Shortening url failed.');
		}
			
		return $response;
	}
}