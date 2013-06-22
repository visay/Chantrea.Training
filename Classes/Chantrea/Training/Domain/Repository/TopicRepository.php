<?php
namespace Chantrea\Training\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Topics
 *
 * @Flow\Scope("singleton")
 */
class TopicRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	 * Find topics by status
	 *
	 * @param string $status The status to find
	 * @param integer $limit Set limit for record to display
	 *
	 * @return object
	 */
	public function findByStatus($status, $limit = 10) {
		$query = $this->createQuery();
		return $query->matching($query->equals('status', $status))
			->setOrderings(array('creationDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING))
			->setLimit($limit)
			->execute();
	}
}
?>