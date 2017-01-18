<?php
namespace App\Presenters;

use \Nette;
use App\Model\ChatModel;

/**
 * Presenter pro http://doge.jecool.net/twitch/, pro pristup do te stranky je potreba se zaregistrovat a prihlasit se
 * @author KORandi
 *
 */

class TwitchPresenter extends BasePresenter
{
	private $chatmodel;
	/**
	 * Presenter pro http://doge.jecool.net/twitch/
	 * @param Nette\Database\Context $database
	 * @param Nette\Http\Request $http
	 * @param Nette\Security\User $user
	 * @param Nette\Http\Session $session
	 * @param Nette\Http\Response $response
	 */
	public function __construct(Nette\Database\Context $database, Nette\Http\Request $http, Nette\Security\User $user, Nette\Http\Session $session, Nette\Http\Response $response){
		parent::__construct($database,$http,$user,$session,$response);
		$this->chatmodel = new ChatModel($database);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \Nette\Application\UI\Presenter::startup()
	 */
	public function startup(){
		parent::startup();
		if(!$this->user->isLoggedIn()){
			$this->flashMessage('You need to log in to see this category.');
			$this->redirect('Homepage:default');
		}
	}
	
	/**
	 * View-Presenter cast
	 */
	public function renderDefault()
	{
		$this->template->chatmessages = $this->chatmodel->fetchall($this->search());
		$this->template->name = $this->http->getQuery('name');
		$this->template->message = $this->http->getQuery('message');
		$this->template->date = $this->http->getQuery('date');
	}
	
	private function search()
	{
		return array('name'=>$this->http->getQuery('name'),'message'=>$this->http->getQuery('message'),'date'=>$this->http->getQuery('date'));
	}
	
	
	/**
	 * Json zpracovani dotazu
	 */
	public function actionJson(){
		try{
			$this->apiModel->checkCsrfToken();
		}catch(\Exception $e){
			$this->response->setCode(\Nette\Http\IResponse::S403_FORBIDDEN);
			$this->flashMessage($e->getMessage());
			$this->redirect('Homepage:default');
		}
		$a = $this->chatmodel->fetchall($this->search());
		$this->sendResponse( new \Nette\Application\Responses\JsonResponse($a) );
	}

	/**
	 * Json zracovani dotazu (name)
	 */
	
	public function actionNamesJson(){
		try{
			$this->apiModel->checkCsrfToken();
		}catch(\Exception $e){
			$this->response->setCode(\Nette\Http\IResponse::S403_FORBIDDEN);
			$this->flashMessage($e->getMessage());
			$this->redirect('Homepage:default');
		}
		$a = $this->chatmodel->getNames($this->http->getQuery('name'));
		$this->sendResponse( new Nette\Application\Responses\JsonResponse( $a ) );
	}
}

