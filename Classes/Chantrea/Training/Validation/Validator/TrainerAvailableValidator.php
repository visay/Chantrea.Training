<?php
namespace Chantrea\Training\Validation\Validator;

/*                                                                    *
 * This script belongs to the package "Chantrea.Training".    *
 *                                                                    */

use TYPO3\Flow\Annotations as Flow;

/**
 * Account exists validator for the Chantrea.Training package
 * Checks the account if it has ready in account repository
 */
class TrainerAvailableValidator extends \TYPO3\Flow\Validation\Validator\AbstractValidator {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\TopicRepository
	 */
	protected $topicRepository;

	/**
	 * Check if $value is valid. If it is not valid, needs to add an error
	 *
	 * @param string $value Value
	 *
	 * @return void
	 */
	protected function isValid($value) {
		$topic = $this->topicRepository->findAvailableTrainer($value);

		if ($topic) {
			$this->addError('The trainer is not available!', 1221560718);
		}
	}
}

?>