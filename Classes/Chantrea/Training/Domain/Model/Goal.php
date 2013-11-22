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
class Goal {

	/**
	 * @var integer
	 * @Flow\Validate(type="NotEmpty")
	 * @Flow\Validate(argumentName="year", type="Chantrea.Training:YearExists")
	 */
	protected $year;

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 */
	protected $objective;

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 */
	protected $performanceFactor;

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 */
	protected $performanceDevelopment;

	/**
	 * @var \Chantrea\Training\Domain\Model\User
	 * @ORM\ManyToOne
	 */
	protected $owner;

	/**
	 * @return integer
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 * @param integer $year
	 * @return void
	 */
	public function setYear($year) {
		$this->year = $year;
	}

	/**
	 * @return string
	 */
	public function getObjective() {
		return $this->objective;
	}

	/**
	 * @param string $objective
	 * @return void
	 */
	public function setObjective($objective) {
		$this->objective = $objective;
	}

	/**
	 * @return string
	 */
	public function getPerformanceFactor() {
		return $this->performanceFactor;
	}

	/**
	 * @param string $performanceFactor
	 * @return void
	 */
	public function setPerformanceFactor($performanceFactor) {
		$this->performanceFactor = $performanceFactor;
	}

	/**
	 * @return string
	 */
	public function getPerformanceDevelopment() {
		return $this->performanceDevelopment;
	}

	/**
	 * @param string $performanceDevelopment
	 * @return void
	 */
	public function setPerformanceDevelopment($performanceDevelopment) {
		$this->performanceDevelopment = $performanceDevelopment;
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
}
?>