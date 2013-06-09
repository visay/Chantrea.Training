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
     * find schedule topics
     * 
     * @return object
     */
   public function findScheduleTopic() {
		$query = $this->createQuery();
		return $query->matching($query->equals('status', 4))
					->setOrderings(array('trainingDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING))
					->setLimit(10)
					->execute();
    }

    /**(
     * find accepted topics
     * 
     * @return object
     */
    public function findAcceptedTopic() {
		$query = $this->createQuery();
		$constraint = $query->matching($query->equals('status', 2));
		return $query->setOrderings(array('creationDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING))
					->setLimit(10)
					->execute();
	}

    /**
     * find suggeted topics
     * 
     * @return object
     */
    public function findSuggestedTopic() {
		$query = $this->createQuery();
		$query->matching($query->equals('status', 1));
		return $query->setOrderings(array('creationDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING))
					->setLimit(10)
					->execute();
    }
}
?>