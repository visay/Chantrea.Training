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
	public function findByStatus($status, $limit=NULL) {
		$query = $this->createQuery();
		if ($limit) {
			return $query->matching($query->equals('status', $status))
					->setOrderings(array('creationDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING))
					->setLimit($limit)
					->execute();
		} else {
			return $query->matching($query->equals('status', $status))
					->setOrderings(array('creationDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING))
					->execute();
		}
	}

	/**
	 * Find topics by account
	 *
	 * @param string $status The status to find
	 * @param string $account The account to find
	 *
	 * @return object
	 */
	public function findSuggestedByAccount($status, $account) {
		$query = $this->createQuery();
		return $query->matching(
					$query->logicalAnd(
						$query->equals('status', $status),
						$query->equals('account', $account)
					)
				)->execute();
	}
}
?>