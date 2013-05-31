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
class Topic {

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var \DateTime
	 */
	protected $creationDate;

	/**
	 * @var \DateTime
	 */
	protected $trainingDate;

	/**
	 * @var boolean
	 */
	protected $isAccepted;

	/**
	 * @var \Chantrea\Training\Domain\Model\Category
	 * @ORM\ManyToOne
	 */
	protected $category;

	/**
	 * @var \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Trainer>
	 * @ORM\ManyToMany(inversedBy="topics")
	 */
	protected $trainers;

	/**
	 * @var \Chantrea\Training\Domain\Model\Location
	 * @ORM\ManyToOne
	 */
	protected $location;

	/**
	 * @var \TYPO3\Flow\Security\Account
	 * @ORM\ManyToOne
	 */
	protected $user;


	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
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
	 * @return \DateTime
	 */
	public function getCreationDate() {
		return $this->creationDate;
	}

	/**
	 * @param \DateTime $creationDate
	 * @return void
	 */
	public function setCreationDate($creationDate) {
		$this->creationDate = $creationDate;
	}

	/**
	 * @return \DateTime
	 */
	public function getTrainingDate() {
		return $this->trainingDate;
	}

	/**
	 * @param \DateTime $trainingDate
	 * @return void
	 */
	public function setTrainingDate($trainingDate) {
		$this->trainingDate = $trainingDate;
	}

	/**
	 * @return boolean
	 */
	public function getIsAccepted() {
		return $this->isAccepted;
	}

	/**
	 * @param boolean $isAccepted
	 * @return void
	 */
	public function setIsAccepted($isAccepted) {
		$this->isAccepted = $isAccepted;
	}

	/**
	 * @return \Chantrea\Training\Domain\Model\Category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * @param \Chantrea\Training\Domain\Model\Category $category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Trainer>
	 */
	public function getTrainers() {
		return $this->trainers;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Trainer> $trainers
	 * @return void
	 */
	public function setTrainers(\Doctrine\Common\Collections\Collection $trainers) {
		$this->trainers = $trainers;
	}

	/**
	 * @param \Chantrea\Training\Domain\Model\Trainer $trainer
	 * @return void
	 */
	public function addTrainer($trainer) {
		$this->trainers->add($trainer);
	}

	/**
	 * @param \Chantrea\Training\Domain\Model\Trainer $trainer
	 * @return void
	 */
	public function removeTrainer($trainer) {
		$this->trainers->remove($trainer);
	}

	/**
	 * @return \Chantrea\Training\Domain\Model\Location
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * @param \Chantrea\Training\Domain\Model\Location $location
	 * @return void
	 */
	public function setLocation($location) {
		$this->location = $location;
	}

	/**
	 * @return \TYPO3\Flow\Security\Account
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param \TYPO3\Flow\Security\Account $user
	 * @return void
	 */
	public function setUser(\TYPO3\Flow\Security\Account $user) {
		$this->user = $user;
	}

}
?>