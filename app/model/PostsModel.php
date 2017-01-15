<?php

namespace App\Model;

use Nette;

/**
 * Model pro praci s 'Posts' a 'Archive' presenterem
 * @author KORandi
 *
 */

class PostsModel
{
	
	private $database;
	private $limit = 4;
	private $pages = 0;
	
	/**
	 * Model pro praci s 'Posts' a 'Archive' presenterem
	 * @param Nette\Database\Context $database
	 */
	public function __construct(Nette\Database\Context $database){
		$this->database = $database;
	}
	
	/**
	 * Vraci pocet stranek
	 * @return number
	 */
	public function getPages(){
		return $this->pages;
	}
	
	/**
	 * Vraci clanky co maji id=$posts_id
	 * @param int $post_id
	 * @return boolean|\Nette\Database\Row
	 */
	public function fetch($post_id)
	{
		return $this->database->query('
				SELECT *
				FROM `posts`
				WHERE `hide`=0 AND `id` = ',$post_id
				)->fetch();
	}
	
	/**
	 * Vkladani clanku a jeji kategorii
	 * @param array $array
	 * @param array $labels
	 */
	public function insert($array,$labels){
		$this->database->query('
				INSERT INTO `posts` ',$array
				);
		$id_post = $this->database->getInsertId();
		$query = array();
		foreach ($labels as $label){
			$query[] = array(
				'id_post' => $id_post,
				'id_label' => $label['id'],
				'display' => $label['display']
			);
		}
		$this->database->query('
				INSERT INTO `posts_labels`',$query
				);
	}
	
	/**
	 * Obnoveni clanku
	 * @param array $array
	 * @param array $labels
	 */
	public function update($array,$labels){
		$this->database->table('posts')->where(array('id'=>(int)$array['id']))->update($array);
		foreach($labels as $label){
			$this->database->table('posts_labels')->where(array('id_post'=>(int)$array['id'],'id_label'=>(int)$label['id']))->update(array('display'=>$label['display']));
		}
	}
	
	/**
	 * Rozdeleni clanek podle stranek
	 * @return \Nette\Database\IRow[]
	 */
	public function fetchAll()
	{
		$this->pages = ceil($this->total() / $this->limit);
		if ($this->offsetCalc() < 0){
			return NULL;
		}
		return $this->database->table('posts')
							  ->where('hide',0)
							  ->order('date DESC')
							  ->limit((int)$this->limit,(int)$this->offsetCalc())
							  ->fetchAll();
	}
	
	/**
	 * Vrati vsechny archivy co maji tag bot tridene podle roku
	 * @return \Nette\Database\IRow Vraceni IRow dle roku
	 */
	public function fetchAllArchive()
	{
		$archives= $this->database->query("
				SELECT posts.id,posts.date,posts.title
				FROM posts_labels
				LEFT JOIN posts
				ON posts_labels.id_post=posts.id
				LEFT JOIN labels
				ON posts_labels.id_label=labels.id
				WHERE labels.discription='bot' AND posts.hide=0 AND posts_labels.display=1
				ORDER BY posts.date DESC
				")->fetchAll();
		$toRet = array();
		foreach($archives as $archive){
			$year = $archive['date']->format('Y');
			$toRet[$year][] = $archive;
		}
		return $toRet;
	}
	
	/**
	 * Odstraneni/Schovani clanku 
	 * @param int $post_id
	 */
	public function remove($post_id)
	{
		$this->database->table('posts')->where('id',(int)$post_id)->update(array('hide'=>1));
	}
	
	/**
	 * Vraci kategorie clanku
	 * @param int $idPost
	 * @return \Nette\Database\IRow[]
	 */
	public function getLabels($idPost)
	{
		return $this->database->query('
				SELECT labels.*
				FROM labels
				RIGHT JOIN posts_labels
				ON labels.id = posts_labels.id_label
				WHERE posts_labels.id_post ='.(int)$idPost.' AND posts_labels.display = 1'
				)->fetchAll();
	}
	
	/**
	 * Spocitani zacatku stranky
	 * @return number
	 */
	public function offsetCalc (){
		return ($this->pageCalc() - 1)  * $this->limit;
	}
	
	/**
	 * Spocitani pocet stranek
	 * @return mixed
	 */
	public function pageCalc(){
		return min($this->pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
				'options' => array(
						'default'   => 1,
						'min_range' => 1,
				),
		)));
	}
	
	/**
	 * Spocitani celkovy pocet stranek
	 * @return number
	 */
	public function total()
	{
		return $this->database->table('posts')->where('hide',0)->count();
	}
}