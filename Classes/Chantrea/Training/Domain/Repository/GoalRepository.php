<?php
namespace Chantrea\Training\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class GoalRepository extends Repository {

	/**
	 * Find a goal object by year
	 *
	 * @param integer $year The year of the goal to search for
	 * @param integer $owner The owner of the goal to search for
	 *
	 * @return \Chantrea\Training\Domain\Model\Goal
	 */
	public function findByYear($year, $owner) {
		$query = $this->createQuery();
		$constraint = $query->equals('year', $year);
		return $query->matching($query->logicalAnd($constraint, $query->equals('owner', $owner)))
		->execute()->getFirst();
	}

	/**
	 * Find a goal object by user
	 *
	 * @param string $user The user of the goal to search for
	 *
	 * @return \Chantrea\Training\Domain\Model\Goal
	 */
	public function findByUser($user) {
		$query = $this->createQuery();
		return $query->matching($query->equals('owner', $user))
		->execute();
	}
}
?>