<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Location
 *
 * @Flow\Entity
 */
class Location {

	/**
	 * The room
	 * @var string
	 */
	protected $room;


	/**
	 * Get the Location's room
	 *
	 * @return string The Location's room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * Sets this Location's room
	 *
	 * @param string $room The Location's room
	 * @return void
	 */
	public function setRoom($room) {
		$this->room = $room;
	}

}
?>