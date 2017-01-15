<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;


/**
 * Uzivatelsky model
 */
class UserManager extends Nette\Object implements Nette\Security\IAuthenticator
{
	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'name',
		COLUMN_EMAIL = 'email',
		COLUMN_PASSWORD_HASH = 'password',
		COLUMN_ROLE = 'role';


	private $database;

	/**
	 * Uzivatelsky model
	 * @param Nette\Database\Context $database
	 */
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * Prihlaseni uzivatele
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update(array(
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			));
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}
	
	/**
	 * Kontrola udaju prez json
	 * @param string $username
	 * @param string $password
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticateJson($username,$password)
	{
		$row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();
	
		if (!$row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
	
		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
	
		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update(array(
					self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			));
		}
	}
	
	/**
	 * Kontrola zda uzivatel uz existuje
	 * @param string $username
	 * @throws Nette\Security\AuthenticationException
	 */
	public function namecheck($username)
	{
		$row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();
	
		if ($row) {
			throw new Nette\Security\AuthenticationException('The user already exists.', self::IDENTITY_NOT_FOUND);
		} 
	}


	/**
	 * Prida noveho uzivatele.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return void
	 * @throws DuplicateNameException
	 */
	public function add($username, $password, $email)
	{
		try {
			$this->database->table(self::TABLE_NAME)->insert(array(
				self::COLUMN_NAME => $username,
				self::COLUMN_EMAIL => $email,
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
				self::COLUMN_ROLE => 'user'
			));
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}

}



class DuplicateNameException extends \Exception
{}
