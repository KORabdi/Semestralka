<?php
use Nette\Application\UI;
/**
 * Objekt (komponenta) admin pro 'Gallery' presenter
 * @author KORandi
 */
class gallerynavControl extends UI\Control
{
	private $status;

	/**
	 * Objekt (komponenta) admin pro 'Gallery' presenter
	 * @param boolean $status Je uzivatel admin nebo ne?
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
		$template->render(__DIR__ . '/AdminGalleryNavControl.latte');
	}
}