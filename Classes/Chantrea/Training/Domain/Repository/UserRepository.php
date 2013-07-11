<?php
namespace Chantrea\Training\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Users
 *
 * @Flow\Scope("singleton")
 */
class UserRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	 * Find a user object by email address
	 *
	 * @param string $email The email address of the user to search for
	 *
	 * @return \Chantrea\Training\Domain\Model\User
	 */
	public function findByEmail($email) {
		$query = $this->createQuery();
		return $query->matching($query->equals('email', $email))
		->execute()->getFirst();
	}
}
?>