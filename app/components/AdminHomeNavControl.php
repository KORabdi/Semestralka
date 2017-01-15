<?php
use Nette\Application\UI;
/**
 * Objekt (komponenta) admin pro 'Posts' presenter
 * @author KORandi
 */
class homenavControl extends UI\Control
{
	private $status;
	/**
 	 * Objekt (komponenta) admin pro 'Posts' presenter
	 * @param bool $status Je uzivatel admin?
	 */
	public function __construct($status)
	{
		parent::__construct();
		$this->status = $status;
	}

	public function render()
	{
		$template = $this->template;
		$template->status = $this->status;
		$template->render(__DIR__ . '/AdminHomeNavControl.latte');
	}
}