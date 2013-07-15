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
	 * Find topics by filter
	 *
	 * @param string $user The user to find
	 * @param string $status The status to find
	 * @param string $category The category to find
	 *
	 * @return object
	 */
	public function findTopicByFilter($user, $status, $category) {
		$query = $this->createQuery();
		$constraint = NULL;
		if ($user) {
			$constraint = $query->equals('owner', $user);
		}

		if ($status) {
			if ($constraint != NULL) {
				$constraint = $query->logicalAnd(
							$constraint,
							$query->equals('status', $status)
						);
			} else {
				$constraint = $query->equals('status', $status);
			}
		}

		if ($category) {
			if ($constraint != NULL) {
				$constraint = $query->logicalAnd(
							$constraint,
							$query->equals('category', $category)
						);
			} else {
				$constraint = $query->equals('category', $category);
			}
		}

		return $query->matching($constraint)->execute();
	}
}
?>