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
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
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
	 * @Flow\Validate(type="NotEmpty")
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
	 * @var \Chantrea\Training\Domain\Model\Type
	 * @ORM\ManyToOne
	 */
	protected $type;


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
	public function setTrainingDateTo($trainingDateTo) {
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
	public function setTrainingDateFrom($trainingDateFrom) {
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
	public function setCategory($category) {
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
	 * getVoteUsers
	 *
	 * @return \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\User>
	 */
	public function getVoteUsers() {
		return $this->voteUsers;
	}

	/**
	 * setVoteUsers
	 *
	 * @param \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\User> $voteUsers voteUsers
	 *
	 * @return void
	 */
	public function setVoteUsers(\Doctrine\Common\Collections\Collection $voteUsers) {
		$this->voteUsers = $voteUsers;
	}

	/**
	 * addVoteUser
	 *
	 * @param \Chantrea\Training\Domain\Model\User $voteUser voteUser
	 *
	 * @return void
	 */
	public function addVoteUser(User $voteUser) {
		$this->voteUsers->add($voteUser);
	}

	/**
	 * removeVoteUser
	 *
	 * @param \Chantrea\Training\Domain\Model\User $voteUser $voteUser
	 *
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
	public function setLocation($location) {
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
	 */
	public function getIdentifier() {
		return $this->persistenceManager->getIdentifierByObject($this);
	}

	/**
	 * Check if this topic is not yet voted by current login user
	 *
	 * @return boolean
	 */
	public function isNotYetVotedByCurrentUser() {
		$voteUsers = $this->getVoteUsers();
		$loginUser = $this->securityContext->getAccount()->getParty();
		foreach ($voteUsers as $voteUser) {
			if ($voteUser === $loginUser) {
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * getType
	 *
	 * @return \Chantrea\Training\Domain\Model\Type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * setType
	 *
	 * @param \Chantrea\Training\Domain\Model\Type $type type
	 *
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}
}
?>
