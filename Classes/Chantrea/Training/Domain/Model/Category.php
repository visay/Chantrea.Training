<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Category {

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * The description
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @ORM\Column(type="text")
	 */
	protected $description;


	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	* Get identifier
	*
	* @return string
	*/
	public function getIdentifier() {
		return $this->persistenceManager->getIdentifierByObject($this);
	}

}
?>