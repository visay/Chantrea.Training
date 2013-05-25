<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Trainer
 *
 * @Flow\Entity
 */
class Trainer {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


	/**
	 * Get the Trainer's name
	 *
	 * @return string The Trainer's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Trainer's name
	 *
	 * @param string $name The Trainer's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
?>