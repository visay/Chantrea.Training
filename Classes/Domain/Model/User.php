<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A User
 *
 * @FLOW3\Scope("prototype")
 * @FLOW3\Entity
 */
class User {

	/**
	 * The username
	 * @var string
	 */
	protected $username;

	/**
	 * The password
	 * @var string
	 */
	protected $password;


	/**
	 * Get the User's username
	 *
	 * @return string The User's username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * Sets this User's username
	 *
	 * @param string $username The User's username
	 * @return void
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * Get the User's password
	 *
	 * @return string The User's password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Sets this User's password
	 *
	 * @param string $password The User's password
	 * @return void
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

}
?>