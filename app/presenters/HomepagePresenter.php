<?php

namespace App\Presenters;

use Nette;
use App\Model;
use App\Model\PostsModel;

/**
 * Presenter pro 'Posts'
 * @author KORandi
 *
 */

class HomepagePresenter extends BasePresenter
{
	private $postModel;
	/**
	 * Je to admin?
	 * @var bool
	 */
	private $admin = False;
	/**
	 * Presenter pro 'Posts'
	 * @param Nette\Database\Context $database
	 * @param Nette\Http\Request $http
	 * @param Nette\Security\User $user
	 * @param Nette\Http\Session $session
	 * @param Nette\Http\Response $response
	 */
	public function __construct(Nette\Database\Context $database, Nette\Http\Request $http, Nette\Security\User $user, Nette\Http\Session $session,Nette\Http\Response $response){
		parent::__construct($database, $http, $user, $session,$response);
		$this->admin = $this->user->isInRole('admin');
		$this->postModel = new \App\Model\PostsModel($database);
	}
	
	/**
	 * Najdi konec strankovani
	 * @return mixed
	 */
	private function endCalc (){
		return min(($this->offsetCalc() + $this->postModel->$limit), $this->postModel->total());
	}
	
	/**
	 * Najdi zacatek strankovani
	 * @return number
	 */
	public function startCalc (){
		return $this->offsetCalc + 1;
	}
	
	
	/**
	 * View-Controler cast
	 */
	public function renderDefault()
	{
		$this->template->posts = $this->postModel->fetchAll();
		$this->template->page = $this->getPage();
		$this->template->pages = $this->postModel->getPages();
		$this->template->showLabels = function($idPost){return $this->postModel->getLabels($idPost);};
		$this->template->admin = $this->admin;
	}
	
	/**
	 * Odstrani clanek
	 * @param unknown $post_id
	 */
	public function actionRemove($post_id){
		if($this->admin){
			$this->postModel->remove($post_id);
		}
		$this->redirect('Homepage:default');
	}
	
	/**
	 * Pridej clanek
	 */
	public function actionAdd(){
		if($this->admin){
			$this->postModel->insert(array(
					'title' => $this->http->getPost('title'),
					'body' => $this->http->getPost('body'),
					'date' => new \DateTime(),
					'hide' => 0
			),$this->http->getPost('labels'));
		}

		$this->redirect('Homepage:default');
	}
	
	/**
	 * Uprav clanek
	 */
	public function actionEdit(){
		if($this->admin){
			$this->postModel->update(array(
					'id' => $this->http->getPost('id'),
					'title' => $this->http->getPost('title'),
					'body' => $this->http->getPost('body'),
					'hide' => 0
			),$this->http->getPost('labels'));
		}
	
		$this->redirect('Homepage:default');
	}
	
	
	/**
	 * Pripoj komponentu \homenavControl (admin komponenta)
	 * @return \homenavControl
	 */
	protected function createComponentHomenav()
	{
		$nav = new \homenavControl($this->admin);
		return $nav;
	}
	
	/**
	 * Vrat stranky
	 * @return number|mixed|string
	 */
	public function getPage()
	{
		if($this->http->getQuery('page')){
			if(is_numeric($this->http->getQuery('page'))){
				if($this->http->getQuery('page') > $this->postModel->getPages()){ 
					return $this->postModel->getPages();
				}else{
					return $this->http->getQuery('page');
				}
			}else{
				return 1;
			}
		}else{
			return 1;
		}
	}

}
