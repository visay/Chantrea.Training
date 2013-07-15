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
class Location {

	/**
	 * @var string
	 */
	protected $room;

	/**
	 * The description
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @ORM\Column(type="text")
	 */
	protected $description;

	/**
	 * The topics contained in this category
	 *
	 * @var \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Topic>
	 * @ORM\OneToMany(targetEntity="Chantrea\Training\Domain\Model\Topic", mappedBy="location")
	 */
	protected $topics;

	/**
	 * @return string
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * @param string $room
	 * @return void
	 */
	public function setRoom($room) {
		$this->room = $room;
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
	 * Gets all topics in this category
	 *
	 * @return \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Topic> The topics of this category
	 */
	public function getTopics() {
		return $this->topics;
	}
}
?>