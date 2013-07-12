<?php
namespace Chantrea\Training\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
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
	 * @Flow\Validate(type="Text")
	 * @ORM\Column(type="text")
	 */
	protected $shortDescription;

	/**
	 * The creation date
	 *
	 * @var \DateTime
	 */
	protected $creationDate;

	/**
	 * @var \DateTime
	 * @ORM\Column(nullable=true)
	 */
	protected $trainingDateTo;

	/**
	 * @var \DateTime
	 * @ORM\Column(nullable=true)
	 */
	protected $trainingDateFrom;

	/**
	 * @var string
	 */
	protected $status;

	/**
	 * @var \Chantrea\Training\Domain\Model\Category
	 * @ORM\ManyToOne
	 */
	protected $category;

	/**
	 * @var \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\User>
	 * @ORM\ManyToMany(inversedBy="topics")
	 */
	protected $trainers;

	/**
	 * @var \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\User>
	 * @ORM\ManyToMany(inversedBy="topics")
	 */
	protected $voteUsers;

	/**
	 * @var \Chantrea\Training\Domain\Model\Location
	 * @ORM\ManyToOne
	 */
	protected $location;

	/**
	 * @var \Chantrea\Training\Domain\Model\User
	 * @ORM\ManyToOne
	 */
	protected $owner;

	
	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 * @deprecated
	 */
	protected $persistenceManager;

	/**
	 * Constructs a new topic's creation date
	 *
	 * @deprecated
	 */
	public function __construct() {
		$this->creationDate = new \DateTime();
		$this->trainers = new \Doctrine\Common\Collections\ArrayCollection();
		$this->voteUsers = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * getTitle
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * setTitle
	 *
	 * @param string $title title
	 *
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
	 *
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
	 * getTrainingDateTo
	 *
	 * @return \DateTime
	 */
	public function getTrainingDateTo() {
		return $this->trainingDateTo;
	}

	/**
	 * setTrainingDateTo
	 *
	 * @param \DateTime $trainingDateTo trainingDateTo
	 *
	 * @return void
	 */
	public function setTrainingDateTo(\DateTime $trainingDateTo) {
		$this->trainingDateTo = $trainingDateTo;
	}

	/**
	 * getTrainingDateFrom
	 *
	 * @return \DateTime
	 */
	public function getTrainingDateFrom() {
		return $this->trainingDateFrom;
	}

	/**
	 * setTrainingDateFrom
	 *
	 * @param \DateTime $trainingDateFrom trainingDateFrom
	 *
	 * @return void
	 */
	public function setTrainingDateFrom(\DateTime $trainingDateFrom) {
		$this->trainingDateFrom = $trainingDateFrom;
	}

	/**
	 * getStatus
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * setStatus
	 *
	 * @param string $status status
	 *
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * getCategory
	 *
	 * @return \Chantrea\Training\Domain\Model\Category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * setCategory
	 *
	 * @param \Chantrea\Training\Domain\Model\Category $category category
	 *
	 * @return void
	 */
	public function setCategory(Category $category) {
		$this->category = $category;
	}

	/**
	 * getTrainers
	 *
	 * @return \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\User>
	 */
	public function getTrainers() {
		return $this->trainers;
	}

	/**
	 * setTrainers
	 *
	 * @param \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\User> $trainers trainers
	 *
	 * @return void
	 */
	public function setTrainers(\Doctrine\Common\Collections\Collection $trainers) {
		$this->trainers = $trainers;
	}

	/**
	 * addTrainer
	 *
	 * @param \Chantrea\Training\Domain\Model\User $trainer trainer
	 *
	 * @return void
	 */
	public function addTrainer(User $trainer) {
		$this->trainers->add($trainer);
	}

	/**
	 * removeTrainer
	 *
	 * @param \Chantrea\Training\Domain\Model\User $trainer trainer
	 *
	 * @return void
	 */
	public function removeTrainer(User $trainer) {
		$this->trainers->remove($trainer);
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\User>
	 */
	public function getVoteUsers() {
		return $this->voteUsers;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\User> $voteUsers
	 * @return void
	 */
	public function setVoteUsers(\Doctrine\Common\Collections\Collection $voteUsers) {
		$this->voteUsers = $voteUsers;
	}
	
	/**
	 * @param \Chantrea\Training\Domain\Model\User $voteUsers
	 * @return void
	 */
	public function addVoteUser(User $voteUser) {
		$this->voteUsers->add($voteUser);
	}
	
	/**
	 * @param \Chantrea\Training\Domain\Model\User $trainer
	 * @return void
	 */
	public function removeVoteUser(User $voteUser) {
		$this->voteUsers->remove($voteUser);
	}

	/**
	 * getLocation
	 *
	 * @return \Chantrea\Training\Domain\Model\Location
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * setLocation
	 *
	 * @param \Chantrea\Training\Domain\Model\Location $location location
	 *
	 * @return void
	 */
	public function setLocation(Location $location) {
		$this->location = $location;
	}

	/**
	 * getOwner
	 *
	 * @return \Chantrea\Training\Domain\Model\User
	 */
	public function getOwner() {
		return $this->owner;
	}

	/**
	 * setOwner
	 *
	 * @param \Chantrea\Training\Domain\Model\User $owner owner
	 *
	 * @return void
	 */
	public function setOwner(\Chantrea\Training\Domain\Model\User $owner) {
		$this->owner = $owner;
	}

	/**
	 * Gets identifier
	 *
	 * @return string
	 * @deprecated
	 */
	public function getIdentifier() {
		return $this->persistenceManager->getIdentifierByObject($this);
	}
}
?>
