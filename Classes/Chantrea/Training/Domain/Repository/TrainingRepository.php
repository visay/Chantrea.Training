<?php
namespace Chantrea\Training\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Trainings
 *
 * @Flow\Scope("singleton")
 */
class TrainingRepository extends \TYPO3\Flow\Persistence\Repository {

	// add customized methods here
	public function findAll() {
		$query = $this->createQuery();

		return $query->setOrderings(
			array(
				'vote' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING
			)
		)
		->execute();
	}

}
?>