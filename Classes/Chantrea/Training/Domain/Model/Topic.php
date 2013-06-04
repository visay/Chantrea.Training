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
	 * The short description
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={"minimum"=50, "maximum"=255})
	 * @ORM\Column(type="text")
	 */
	protected $shortDescription;

	/**
	 * The creation date
	 *
	 * @var \DateTime
	 */
	//protected $creationDate;

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
	protected $account;


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

	/**
	 * Gets the topic's create date
	 * 
	 * @return \DateTime The topic's create date
	 */
	public function getCreationDate() {
		return $this->creationDate;
	}

	/**
	 * Sets this topic's create date
	 *
	 * @param \DateTime $creationDate The topic's create date
	 *
	 * @return void
	 */
	public function setCreationDate(\DateTime $creationDate) {
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
	public function getAccount() {
		return $this->account;
	}

	/**
	 * @param \TYPO3\Flow\Security\Account $user
	 * @return void
	 */
	public function setAccount(\TYPO3\Flow\Security\Account $account) {
		$this->account = $account;
	}
}
?>