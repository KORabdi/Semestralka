<?php
namespace App\Model;

use Nette;

/**
 * Model pro ovladani komentaru v 'Article' preseneter
 * @author KORandi
 *
 */

class CommentsModel
{
	private $database;
	
	/**
	 * Model pro ovladani komentaru v 'Article' preseneter
	 * @param Nette\Database\Context $database
	 */
	public function __construct(Nette\Database\Context $database){
		$this->database = $database;
	}
	
	/**
	 * Vraci vsechny clanky co obsahuji post_id = $post_id
	 * @param int $post_id
	 * @return \Nette\Database\Table\Selection
	 */
	public function fetch($post_id)
	{
		return $this->database->table('comments')->where('post_id',$post_id);
	}
	
	/**
	 * Vraci vsechny clanky
	 * @return \Nette\Database\Table\Selection
	 */
	public function fetchAll()
	{
		return $this->database->table('comments')->fetchAll();
	}
	
	/**
	 * Vraci pocet komentaru
	 * @return number
	 */
	public function total() 
	{ 
		return $this->database->table('comments')->count();
	}
	
	/**
	 * Vloz komentar
	 * @param array $data
	 */
	public function insert($data)
	{
		$this->database->table('comments')->insert($data);
	}
}