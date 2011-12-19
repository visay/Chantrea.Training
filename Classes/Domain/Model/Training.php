<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Training
 *
 * @FLOW3\Scope("prototype")
 * @FLOW3\Entity
 */
class Training {

	/**
	 * The title
	 * @var string
	 */
	protected $title;

	/**
	 * The description
	 * @var string
	 */
	protected $description;

	/**
	 * The created date
	 * @var DateTime
	 */
	protected $createdDate;
	
	/**
	 * The vote
	 * @var integer
	 */
	protected $vote;
	
	/**
	 * The user
	 * @var Chantrea\Training\Domain\Model\User
	 * @ORM\ManyToOne
	 */
	protected $user;


	/**
	 * Get the Training's title
	 *
	 * @return string The Training's title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets this Training's title
	 *
	 * @param string $title The Training's title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Get the Training's description
	 *
	 * @return string The Training's description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets this Training's description
	 *
	 * @param string $description The Training's description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Get the Training's created date
	 *
	 * @return DateTime The Training's created date
	 */
	public function getCreatedDate() {
		return $this->createdDate;
	}

	/**
	 * Sets this Training's created date
	 *
	 * @param DateTime $createdDate The Training's created date
	 * @return void
	 */
	public function setCreatedDate($createdDate) {
		$this->createdDate = $createdDate;
	}
	
	/**
	 * Get the Training's vote
	 *
	 * @return integer The Training's vote
	 */
	public function getVote() {
		return $this->vote;
	}

	/**
	 * Sets this Training's vote
	 *
	 * @param integer $vote The Training's vote
	 * @return void
	 */
	public function setVote($vote) {
		$this->vote = $vote;
	}
	
	/**
	 * Get the Training's user
	 *
	 * @return Chantrea\Training\Domain\Model\User The Training's user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets this Training's user
	 *
	 * @param Chantrea\Training\Domain\Model\User The Training's user
	 * @return void
	 */
	public function setUser($user) {
		$this->user = $user;
	}

}
?>