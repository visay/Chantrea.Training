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
class Trainer extends \TYPO3\Party\Domain\Model\Person {

	/**
	 * @var string
	 * @ORM\Column(nullable=true)
	 */
	protected $position;

	/**
	 * @var string
	 * @ORM\Column(nullable=true)
	 */
	protected $email;

	/**
	 * @var \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Topic>
	 * @ORM\ManyToMany(mappedBy="trainers")
	 */
	protected $topics;


	/**
	 * @return string
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * @param string $position
	 * @return void
	 */
	public function setPosition($position) {
		$this->position = $position;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Topic>
	 */
	public function getTopics() {
		return $this->topics;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection<\Chantrea\Training\Domain\Model\Topic> $topics
	 * @return void
	 */
	public function setTopics(\Doctrine\Common\Collections\Collection $topics) {
		$this->topics = $topics;
	}

	/**
	 * @param \Chantrea\Training\Domain\Model\Topic $topic
	 * @return void
	 */
	public function addTopic($topic) {
		$this->topics->add($topic);
	}

	/**
	 * @param \Chantrea\Training\Domain\Model\Topic $topic
	 * @return void
	 */
	public function removeTopic($topic) {
		$this->topics->remove($topic);
	}

}
?>