<?php
namespace App\Presenters;

use Nette;
use App\Model\UserManager;
use App\Model\ApiModel;


/**
 * Presenter pro praci s uzivatelskymi ucty
 * @author KORandi
 *
 */

class UserPresenter extends BasePresenter
{	
	private $userManager;
	/**
	 *  Presenter pro praci s uzivatelskymi ucty
	 */
	public function __construct(Nette\Database\Context $database, Nette\Http\Request $http, Nette\Security\User $user, Nette\Http\Session $session,Nette\Http\Response $response){
		parent::__construct($database, $http, $user, $session,$response);
		$this->userManager = new UserManager($database);
	}
	
	/**
	 * kontrola csrf tokenu nazacatku
	 * {@inheritDoc}
	 * @see \Nette\Application\UI\Presenter::startup()
	 */
	public function startup()
	{
		parent::startup();
		if($this->presenter->getView() == 'default') return;
		if($this->presenter->getView() == 'register') return;
		if($this->presenter->getAction() == 'logout') return;
			
		try{
			$this->apiModel->checkCsrfToken();
		}catch(\Exception $e){
			$this->response->setCode(\Nette\Http\IResponse::S403_FORBIDDEN);
			$this->flashMessage($e->getMessage());
			if($this->presenter->getAction() == 'add'){
				$this->redirect('User:register');
			}
			$this->redirect('Homepage:default');
		}
	}

	/**
	 * Rendrovani prihlasovaciho formulare
	 */
	
	public function renderDefault(){
		$this->template->name = $this->http->getQuery('name');
	}	
	
	/**
	 * Rendrovani registracniho formulare
	 */
	
	public function renderRegister(){
		$this->template->name = $this->http->getQuery('name');
		$this->template->email = $this->http->getQuery('email');
	}
	
	/**
	 * Prihlaseni
	 */
	
	public function actionLogin(){
		if($this->user->isLoggedIn()){
			$this->redirect('Homepage:default');
		}
		$name = $this->http->getPost('name');
		$password = $this->http->getPost('password');
		try{
			$this->user->login($name,$password);
		}catch(Nette\Security\AuthenticationException $e){
			$this->flashMessage($e->getMessage());
			$this->redirect('User:default',array('name'=>$name));
		}
		$this->redirect('Homepage:default');
	}
	
	/**
	 * Registrace
	 */
	
	public function actionAdd(){
		if($this->user->isLoggedIn()){
			$this->redirect('Homepage:default');
		}
		$name = $this->http->getPost('name');
		$password = $this->http->getPost('password');
		$email = $this->http->getPost('email');
		if(!\App\Model\FormValidModel::validate($this->http->getPost())){
			$this->flashMessage('Invalid input');
			$this->redirect('User:register',array("name" => $name,"email" => $email));
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->flashMessage('Invalid email');
			$this->redirect('User:register',array("name" => $name,"email" => $email));
		}
		try{
			$this->userManager->add($name, $password, $email);
		}catch(\App\Model\DuplicateNameException $e){
			$this->flashMessage('User already exists!');
			$this->redirect('User:register',array("name" => $name,"email" => $email));
		}
		$this->user->login($name,$password);
		$this->redirect('Homepage:default');
	}
	
	/**
	 * Hledani zda uzivatel jiz existuje
	 */
	
	public function actionNameJson(){
		$a = [];
		if($this->http->getMethod() != "POST"){
			$a = ['status'=>'ERROR','error'=>405,'message'=>'Method Not Allowed'];
			$this->sendResponse( new Nette\Application\Responses\JsonResponse( $a ) );
		}
		try{
			$name = $this->http->getPost('name');
			$this->userManager->namecheck($name);
			$a = ['status'=>'OK'];
		}catch(Nette\Security\AuthenticationException $e){
			$a = ['status'=>'ERROR','error'=>$e->getCode(),'message'=>$e->getMessage()];
		}
		$this->sendResponse( new Nette\Application\Responses\JsonResponse( $a ) );
	}
	
	/**
	 * Overovani formulare prez JSON
	 */
	
	public function actionLoginJson(){
		$a = [];
		if($this->http->getMethod() != "POST"){
			$a = ['status'=>'ERROR','error'=>405,'message'=>'Method Not Allowed'];
			$this->sendResponse( new Nette\Application\Responses\JsonResponse( $a ) );
		}
		try{
			$name = $this->http->getPost('name');
			$password = $this->http->getPost('password');
			$this->userManager->authenticateJson($name,$password);
			$a = ['status'=>'OK'];
		}catch(Nette\Security\AuthenticationException $e){
			$a = ['status'=>'ERROR','error'=>$e->getCode(),'message'=>$e->getMessage()];
		}
		$this->sendResponse( new Nette\Application\Responses\JsonResponse( $a ) );
	}
	
	/**
	 * Odhlaseni uzivatele
	 */
	
	public function actionLogout(){
		$this->user->logout();
		$this->redirect('Homepage:default');
	}

}