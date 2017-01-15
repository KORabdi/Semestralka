<?php

use Nette\Application\UI;
 /**
  * Objekt(komponenta) horniho menu
  * @author KORandi
  */
class navControl extends UI\Control
{
	private $status;
	private $session;
	private $security;
	/**
	 * Objekt(komponenta) horniho menu
	 * @param boolean $status Je uzivatel prihlaseny nebo ne?
	 * @param Nette\Http\Session $session
	 */
	public function __construct($status,Nette\Http\Session $session)
	{
		parent::__construct();
		$this->status = (bool)$status;
		$this->session = $session;
	}
	
	public function render()
	{
		$template = $this->template;
		$template->status = $this->status;
		$template->csrf_token = $this->session->getSection('Csrf-token')->value;
		$template->render(__DIR__ . '/NavControl.latte');
	}
}