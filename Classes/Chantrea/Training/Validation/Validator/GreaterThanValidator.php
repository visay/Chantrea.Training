<?php
namespace Chantrea\Training\Validation\Validator;

/*                                                                    *
 * This script belongs to the package "Chantrea.Training".    *
 *                                                                    */

use TYPO3\Flow\Annotations as Flow;

/**
 * GreaterThan validator for the Chantrea.Training package
 * Checks the first value if it is greater than second value
 */
class GreaterThanValidator extends \TYPO3\Flow\Validation\Validator\AbstractValidator {

	/**
	 * Check if $value is valid. If it is not valid, needs to add an error.
	 *
	 * @param array $value Value
	 *
	 * @return void
	 */
	protected function isValid($value) {
			// check that the passwords are the same
		if ($value->getTrainingDateTo() <= $value->getTrainingDateFrom()) {
			$this->addError('TrainingDateTo need to be greater than TrainingDateFrom', 1221560718);
		}
	}
}

?>