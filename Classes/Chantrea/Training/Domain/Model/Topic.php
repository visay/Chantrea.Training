<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Topic
 *
 * @Flow\Entity
 */
class Topic {

	/**
	 * The title
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={"minimum"=5, "maximum"=50})
	 */
	protected $title;

	/**
	 * The short description
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={"minimum"=50, "maximum"=255})
	 * @ORM\Column(type="text")
	 */
	protected $shortDescription;


	/**
	 * Get the Topic's title
	 *
	 * @return string The Topic's title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets this Topic's title
	 *
	 * @param string $title The Topic's title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Get the Topic's short description
	 *
	 * @return string The Topic's short description
	 */
	public function getShortDescription() {
		return $this->shortDescription;
	}

	/**
	 * Sets this Topic's short description
	 *
	 * @param string $shortDescription The Topic's short description
	 * @return void
	 */
	public function setShortDescription($shortDescription) {
		$this->shortDescription = $shortDescription;
	}

}
?>