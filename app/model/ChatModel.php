<?php
namespace App\Model;

use Nette;

/**
 * Model pro praci s 'Chat' presetnerem
 * @author KORandi
 *
 */

class ChatModel
{
	private $database;
	
	/**
	 * Model pro praci s 'Chat' presenterem
	 * @param Nette\Database\Context $database
	 */
	public function __construct(Nette\Database\Context $database){
		$this->database = $database;
	}
	
	
	/**
	 * Vraci 50 zaznamu z chatu
	 * @param array $array Nastaveni filtru (message,name,date)
	 * @return \Nette\Database\IRow[]
	 */
	public function fetchAll($array=NULL)
	{
		$arr = array();
		if(!isset($array['message']) || $array['message']==""){
			$arr['message'] = " AND 1=1 ";
		}else{
			$arr['message'] = " AND `message` LIKE '%".$this->mres($array['message'])."%' ";
		}
		if(!isset($array['name']) || $array['name']==""){
			$arr['name'] = " AND 1=1 ";
		}else{
			$arr['name'] = " AND `name`='".strtolower($this->mres($array['name']))."' ";
		}
		if(!isset($array['date']) || $array['date']==""){
			$arr['date'] = " AND 1=1 ORDER BY date DESC, id DESC";
		}else{
			$date = new \DateTime($array['date']);
			$arr['date'] = " AND `date`>='".$this->mres($date->format("Y-m-d H:i"))."' ORDER BY date ASC, id ASC";
		}
		return $this->database->query("
				SELECT *
				FROM `chat`
				WHERE 1=1 ".implode(" ",$arr)."
				LIMIT 50
				")->fetchAll();
	}

	/**
	 * Vraci jmena 5 uzivatelu ktery se podobaji dotazu
	 * @param array $input
	 * @return \Nette\Database\IRow[]
	 */
	public function getNames($input){
		$input = $this->mres($input);
		if (!isset($input) ||  $input == ""){
			$input = "1=1";
		}else{
			$input = "`name` LIKE '".$input."%'";
		}
		return $this->database->query('
				SELECT `name`
				FROM `chat_users`
				WHERE '.$input.'
				LIMIT 5
				')->fetchAll();
	}
	
	
	/**
	 * Vyescapovani vstupnich dat 
	 * @param mixed $value
	 * @return mixed
	 */
	private function mres($value)
	{
		$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
		$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
	
		return str_replace($search, $replace, $value);
	}
}