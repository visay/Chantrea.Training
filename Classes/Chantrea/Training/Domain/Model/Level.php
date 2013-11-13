<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * Level
 *
 * @Flow\Entity
 *
 */
class Level {

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
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
	 * The topics contained in this type
	 *
	 * @var \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Topic>
	 * @ORM\OneToMany(targetEntity="Chantrea\Training\Domain\Model\Topic", mappedBy="type")
	 */
	protected $topics;


	/**
	 * getName
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * setName
	 *
	 * @param string $name name
	 *
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * getDescription
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * setDescription
	 *
	 * @param string $description description
	 *
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

	/**
	 * Gets all topics in this level
	 *
	 * @return \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Topic> The topics of this level
	 */
	public function getTopics() {
		return $this->topics;
	}

}
?>