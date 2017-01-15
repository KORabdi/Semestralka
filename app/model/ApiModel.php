<?php
namespace App\Model;

use Nette;

/**
 * Model pro nastaveni REST API aplikace
 * @author KORandi
 *
 */
class ApiModel {
	
	private $http;
	private $session;
	private $response;
	/**
	 * Model pro nastaveni REST API aplikace
	 * @param Nette\Http\Request $http
	 * @param Nette\Http\Response $response
	 * @param Nette\Http\Session $session
	 */
	public function __construct(Nette\Http\Request $http, Nette\Http\Response $response, Nette\Http\Session $session ){
		$this->http = $http;
		$this->response = $response;
		$this->session = $session;
	}
	
	/**
	 * Kontrola CSRF tokenu
	 * @throws \Exception
	 */
	public function checkCsrfToken(){
		$clientkey = $this->http->getPost('csrf-token') ? $this->http->getPost('csrf-token') : $this->http->getQuery('csrf-token');
		$serverkey = $this->session->getSection('Csrf-token')->value;
		if(!isset($clientkey) || !isset($serverkey)){
			throw new \Exception('Wrong token.');	
		}
		if($clientkey != $serverkey){
			throw new \Exception('Permission denied.');
		}
	}
	
	/**
	 * Nastaveni csrf tokenu
	 * @param string $time Nastaveni casu, format: 1second,2seconds,1minute,2minutes,1hour...
	 */
	public function setCsrfToken($time){
		$ses = $this->session->getSection('Csrf-token');
		$ses->setExpiration($time);
		$ses->value = bin2hex(openssl_random_pseudo_bytes(16));
	}
}