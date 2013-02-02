<?php
namespace Chantrea\Training\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A repository for Trainings
 *
 * @FLOW3\Scope("singleton")
 */
class TrainingRepository extends \TYPO3\FLOW3\Persistence\Repository {

	// add customized methods here
	public function findAll() {
		$query = $this->createQuery();

		return $query->setOrderings(
			array(
				'vote' => \TYPO3\FLOW3\Persistence\QueryInterface::ORDER_DESCENDING
			)
		)
		->execute();
	}

}
?>