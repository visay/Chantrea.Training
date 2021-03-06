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
	 * @param string   $status      The status to find
	 * @param integer  $limit       Set limit for record to display
	 * @param datetime $currentDate The current date to compare
	 *
	 * @return object
	 */
	public function findByStatus($status, $limit=NULL, $currentDate=NULL) {
		$query = $this->createQuery();
		$constraint = NULL;
		$orderBy = array('creationDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING);
		if ($currentDate != NULL) {
			$constraint = $query->greaterThan('trainingDateTo', $currentDate);
			$orderBy = array('trainingDateTo' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING);
		}
		if ($constraint != NULL) {
			$constraint = $query->logicalAnd(
							$constraint,
							$query->equals('status', $status)
						);
		} else {
			$constraint = $query->equals('status', $status);
		}
		if ($limit) {
			return $query->matching($constraint)
					->setOrderings($orderBy)
					->setLimit($limit)
					->execute();
		} else {
			return $query->matching($constraint)
					->setOrderings($orderBy)
					->execute();
		}
	}

	/**
	 * Find topics by filter
	 *
	 * @param string $user     The user to find
	 * @param string $status   The status to find
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

	/**
	 * Find archieve topics
	 *
	 * @param datetime $currentDate The current date to compare
	 * @param string   $status      The status to find
	 *
	 * @return object
	 */
	public function findArchieve($currentDate, $status) {
		$query = $this->createQuery();
		$constraint = NULL;
		$constraint = $query->lessThan('trainingDateTo', $currentDate);
		if ($constraint != NULL) {
			$constraint = $query->logicalAnd(
						$constraint,
						$query->equals('status', $status)
					);
		}
		return $query->matching($constraint)
				->setOrderings(array('trainingDateTo' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING))
				->execute();
	}

	/**
	 * findAvailableLocation
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic
	 *
	 * @return \Chantrea\Training\Domain\Model\Topic $topic
	 */
	public function findAvailableLocation(\Chantrea\Training\Domain\Model\Topic $topic) {
		$query = $this->createQuery();
		$constraintFrom = $query->logicalAnd(
			$query->lessThan('trainingDateFrom', $topic->getTrainingDateFrom()),
			$query->greaterThan('trainingDateTo', $topic->getTrainingDateFrom())
		);
		$constraintTo = $query->logicalAnd(
			$query->lessThan('trainingDateFrom', $topic->getTrainingDateTo()),
			$query->greaterThan('trainingDateTo', $topic->getTrainingDateTo())
		);
		$constraintDate = $query->logicalOr($constraintFrom, $constraintTo);
		$constraintOut = $query->logicalAnd(
			$query->greaterThanOrEqual('trainingDateFrom', $topic->getTrainingDateFrom()),
			$query->lessThanOrEqual('trainingDateTo', $topic->getTrainingDateTo())
		);
		$constraintLocation = $query->equals('location', $topic->getLocation());
		$constraintDate = $query->logicalOr($constraintDate, $constraintOut);
		return $query->matching($query->logicalAnd($constraintLocation, $constraintDate))->execute()->getFirst();
	}

	/**
	 * findExistTopic
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic
	 *
	 * @return \Chantrea\Training\Domain\Model\Topic $topic
	 */
	public function findAvailableTrainer(\Chantrea\Training\Domain\Model\Topic $topic) {
		$query = $this->createQuery();
		$constraintFrom = $query->logicalAnd(
			$query->lessThan('trainingDateFrom', $topic->getTrainingDateFrom()),
			$query->greaterThan('trainingDateTo', $topic->getTrainingDateFrom())
		);
		$constraintTo = $query->logicalAnd(
			$query->lessThan('trainingDateFrom', $topic->getTrainingDateTo()),
			$query->greaterThan('trainingDateTo', $topic->getTrainingDateTo())
		);
		$constraintDate = $query->logicalOr($constraintFrom, $constraintTo);
		$constraintOut = $query->logicalAnd(
			$query->greaterThanOrEqual('trainingDateFrom', $topic->getTrainingDateFrom()),
			$query->lessThanOrEqual('trainingDateTo', $topic->getTrainingDateTo())
		);
		$constraintTrainer = $query->equals('trainers', $topic->getTrainers());
		$constraintDate = $query->logicalOr($constraintDate, $constraintOut);
		return $query->matching($query->logicalAnd($constraintTrainer, $constraintDate))->execute()->getFirst();
	}

	/**
	 * Find most popular topics
	 *
	 * @param string   $status      The status to find
	 *
	 * @return object
	 */
	public function findMostPopular($status) {
		$query = $this->createQuery();
		$constraint = NULL;
		return $query->matching(
					$query->logicalNot(
						$query->equals('status', $status)
					))->execute();
	}
}
?>