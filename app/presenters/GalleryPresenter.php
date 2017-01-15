<?php
namespace App\Presenters;

use Nette;
use App\Model\GalleryModel;

/**
 * Presenter pro http://doge.jecool.net/gallery/
 * @author KORandi
 *
 */

class GalleryPresenter extends BasePresenter{
	
	private $galleryModel;
	private $admin = False;
	
	/**
	 * Presenter pro http://doge.jecool.net/gallery/
	 * @param Nette\Database\Context $database
	 * @param Nette\Http\Request $http
	 * @param Nette\Security\User $user
	 * @param Nette\Http\Session $session
	 * @param Nette\Http\Response $response
	 */
	public function __construct(Nette\Database\Context $database, Nette\Http\Request $http, Nette\Security\User $user, Nette\Http\Session $session,Nette\Http\Response $response){
		parent::__construct($database, $http, $user, $session, $response);
		$this->galleryModel = new GalleryModel($database);
		$this->admin = $this->user->isInRole('admin');
	}

	/**
	 * 
	 * {@inheritDoc}
	 * @see \Nette\Application\UI\Presenter::startup()
	 */
	public function startup(){
		parent::startup();
	}
	
	/**
	 * View-Controler cast
	 */
	public function renderDefault(){
		//var_dump($this->galleryModel->getImages());
		//die();
		$this->template->images = $this->galleryModel->fetchAll();
		$this->template->admin = $this->admin;
	}

	/**
	 * Pridej komponentu (admin komponenta)
	 * @return \gallerynavControl
	 */
	protected function createComponentGalleryAdminControl()
	{
		$gallery = new \gallerynavControl($this->admin);
		return $gallery;
	}
	
	/**
	 * Pridej fotku
	 */
	public function actionAdd(){
		if($this->admin){
			$file = $this->http->getFile('pic');
			$description = $this->http->getPost('description');
			$this->galleryModel->save($file,$description);
		}
		$this->redirect('Gallery:default');
	}
	
	/**
	 * Odebrat fotku
	 */
	public function actionRemove()
	{
		if($this->admin){
			$this->galleryModel->remove($this->http->getQuery('id'));
		}
		$this->redirect('Gallery:default');
	}
	
	/**
	 * Upravit fotku
	 */
	public function actionEdit(){
		if($this->admin){
			$this->galleryModel->update(array(
					'id' => $this->http->getPost('id'),
					'description' => $this->http->getPost('description'),
			));
		}
		$this->redirect('Gallery:default');
	}
}