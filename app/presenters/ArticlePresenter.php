<?php

namespace App\Presenters;

use Nette;
use App\Model;
/**
 * Presenter pro clanky
 * @author KORandi
 *
 */
class ArticlePresenter extends BasePresenter
{
	private $postModel;
	private $commentsModel;
	private $articleId;
	
	/**
	 * Presenter pro clanky
	 * @param Nette\Database\Context $database
	 * @param Nette\Http\Request $http
	 * @param Nette\Security\User $user
	 * @param Nette\Http\Session $session
	 * @param Nette\Http\Response $response
	 */
	public function __construct(Nette\Database\Context $database, Nette\Http\Request $http, Nette\Security\User $user, Nette\Http\Session $session, Nette\Http\Response $response)
	{
		parent::__construct($database, $http, $user, $session,$response);
		$this->postModel = new \App\Model\PostsModel($database);
		$this->commentsModel = new \App\Model\CommentsModel($database);
	}
	
	/**
	 * Over zda clanek existuje, pokud ne presmeruj na hlavni stranku
	 * {@inheritDoc}
	 * @see \Nette\Application\UI\Presenter::startup()
	 */
	public function startup()
	{
		parent::startup();
		$postModel = $this->postModel->fetch($this->http->getQuery('articleId'));
		if(!$postModel){
			$this->redirect('Homepage:default');
		}
	}
	
	/**
	 * Pridej komentar (pro nezaregistrovane)
	 */
	public function actionAddCommon(){
		try{
			$this->apiModel->checkCsrfToken();
		}catch(\Exception $e){
			die($e->getMessage());
		}
		if($this->http->getPost('commentSuc')){
			if(!$this->requestCheck()){
				return;
			}
			$this->commentsModel->insert(array(
					'post_id'=>$this->http->getQuery('articleId'),
					'body'=>$this->http->getPost('body'),
					'author'=>$this->http->getPost('author'),
					'email'=>$this->http->getPost('email'),
					'date'=> new \DateTime(),
			));
			$this->redirect('Article:default',$this->http->getQuery('articleId'));
		}
	}
	
	/**
	 * Pridej komentar (pro zaregistrovane)
	 */
	
	public function actionAdd(){
		if(!$this->user->isLoggedIn()){
			$this->flashMessage('You are not signed in');
			$this->redirect('Article:default',$this->http->getQuery('articleId'));
		}
		if($this->http->getPost('commentSuc')){
			$this->requestCheck();
			$this->commentsModel->insert(array(
					'post_id'=>$this->http->getQuery('articleId'),
					'body'=>$this->http->getPost('body'),
					'author'=>$this->user->getIdentity()->name,
					'email'=>$this->user->getIdentity()->email,
					'date'=> new \DateTime(),
			));
			$this->redirect('Article:default',$this->http->getQuery('articleId'));
		}
	}
	
	/**
	 * View-Controler cast
	 * @param unknown $articleId
	 */
	
	public function renderDefault($articleId)
	{
		$this->articleId = $articleId;
		$this->template->post = $this->postModel->fetch($this->http->getQuery('articleId'));
		$this->template->comments = $this->commentsModel->fetch($articleId);
		$this->template->counter = 0;
		$this->template->isLoggedIn = $this->user->isLoggedIn();
		$this->template->postArray = array();
		$this->template->postArray['body'] = $this->http->getQuery('body');
		$this->template->postArray['email'] = $this->http->getQuery('email');
		$this->template->postArray['author'] = $this->http->getQuery('author');
	}
	
	/**
	 * Obsah clanku pro JSON
	 */
	
	public function actionJson(){
		$a = $this->postModel->fetch($this->http->getQuery('articleId'));
		$this->sendResponse( new Nette\Application\Responses\JsonResponse( $a ) );
	}
	
	/**
	 * Kategorie clanku pro JSON
	 */
	
	public function actionLabelsJson(){
		$a = $this->postModel->getLabels($this->http->getQuery('articleId'));
		$this->sendResponse( new Nette\Application\Responses\JsonResponse( $a ) );
	}
	
	/**
	 * Validace komentare
	 * @return boolean
	 */
	private function requestCheck(){
		if (! \App\Model\FormValidModel::validate($this->http->getPost())){
			$this->flashMessage('Non valid input(turn on JS for more info)!');
			$this->redirect('Article:default',array(
												"articleId"=>$this->http->getQuery('articleId'),
												"author"=>$this->http->getPost('author'),
												"email"=>$this->http->getPost('email'),
												"body"=>$this->http->getPost('body')
											  ));
			return FALSE;
		}
		return TRUE;
	}
}
