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

}
?>