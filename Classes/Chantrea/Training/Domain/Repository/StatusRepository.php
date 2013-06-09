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
class StatusRepository extends Repository {

    
    /**
     * find new status
     * 
     * @return object
     */
	public function findNewStatus() {
		$query = $this->createQuery();
		return $query->matching($query->equals('title', 'new'))->execute();
	}

}
?>