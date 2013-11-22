<?php
namespace Chantrea\Training\Validation\Validator;

/*                                                                    *
 * This script belongs to the package "Chantrea.Training".    *
 *                                                                    */

use TYPO3\Flow\Annotations as Flow;

/**
 * Year exists validator for the Chantrea.Training package
 * Checks the account if it has ready in account repository
 */
class YearExistsValidator extends \TYPO3\Flow\Validation\Validator\AbstractValidator {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\GoalRepository
	 */
	protected $goalRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

	/**
	 * Check if $value is valid. If it is not valid, needs to add an error
	 *
	 * @param integer $value Value
	 *
	 * @return void
	 */
	protected function isValid($value) {
		$owner = $this->securityContext->getAccount()->getParty();
		$year = $this->goalRepository->findByYear($value, $owner);
		if ($year) {
			$this->addError('You have set goal for this year already.', 1221560718);
		}
	}
}

?>