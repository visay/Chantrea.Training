<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Category
 *
 * @Flow\Entity
 */
class Category {

	/**
	 * The category
	 * @var string
	 */
	protected $category;


	/**
	 * Get the Category's category
	 *
	 * @return string The Category's category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets this Category's category
	 *
	 * @param string $category The Category's category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

}
?>