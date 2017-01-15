<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Presenter;
use App\Model\ApiModel;
use Nette\Utils\DateTime;


/**
 * Bazovy presenter pro vsechny presentery.
 */
class BasePresenter extends Nette\Application\UI\Presenter
{
	protected $user;
	protected $http;
	protected $response;
	protected $apiModel;
	protected $session;
	/**
	 * Bazovy presenter pro vsechny presentery.
	 * @param Nette\Database\Context $database
	 * @param Nette\Http\Request $http
	 * @param Nette\Security\User $user
	 * @param Nette\Http\Session $session
	 * @param Nette\Http\Response $response
	 */
	public function __construct(Nette\Database\Context $database, Nette\Http\Request $http, Nette\Security\User $user, Nette\Http\Session $session, Nette\Http\Response $response){
		parent::__construct($database,$http,$user,$session,$response);
		$this->user = $user;
		$this->http = $http;
		$this->response = $response;
		$this->session = $session;
		$this->apiModel = new ApiModel($http,$this->response,$this->session);
	}
	
	/**
	 * Pred rendrovanim zgeneruj novy csrf token
	 * {@inheritDoc}
	 * @see \Nette\Application\UI\Presenter::beforeRender()
	 */
	protected function beforeRender(){
		parent::beforeRender();
		$this->apiModel->setCsrfToken();
		$this->template->csrf_token = $this->session->getSection('Csrf-token')->value;
	}
	
	/**
	 * pridej komponentu (navigacni menu)
	 * @return \navControl
	 */
	protected function createComponentNavControl()
	{
		$nav = new \navControl($this->user->isLoggedIn(),$this->session);
		return $nav;
	}
	
}
