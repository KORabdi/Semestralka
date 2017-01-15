<?php
namespace App\Model;

use Nette;

/**
 * Objekt na validaci formularu
 * @author KORandi
 *
 */

class FormValidModel
{
	/**
	 * Zkontroluj zda pocet znaku na vstupu je vetsi nez 3
	 * @param mixed $input
	 * @return boolean
	 */
	public static function validate($input){
		foreach ($input as $in){
			if(strlen($in) < 3){
				return False;
			}
		}
		return True;
	}	
}
