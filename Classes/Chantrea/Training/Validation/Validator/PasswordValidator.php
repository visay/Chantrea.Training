<?php
namespace Chantrea\Training\Validation\Validator;

/*                                                                    *
 * This script belongs to the package "Chantrea.Training".    *
 *                                                                    */

use TYPO3\Flow\Annotations as Flow;

/**
 * Password validator for the Chantrea.Training package
 * Checks the password if it has a minimum length and compares password-1
 * with password-2
 */
class PasswordValidator extends \TYPO3\Flow\Validation\Validator\AbstractValidator {

	/**
	 * @var array
	 */
	protected $supportedOptions = array(
		'minimumLength' => array(0, 'Minimum length for a valid password', 'integer')
	);

	/**
	 * Check if $value is valid. If it is not valid, needs to add an error.
	 *
	 * @param array $value Value
	 *
	 * @return void
	 */
	protected function isValid($value) {
			// get the option for the validation
		$minimumLength = $this->options['minimumLength'];

			// check for empty password
		if ($value[0] === '') {
			$this->addError('This property is required.', 1221560718);
		}
			// check for password length
		elseif (strlen($value[0]) < $minimumLength) {
			$this->addError('The password minimum length must be ' . $minimumLength, 1221560718);
		}
			// check that the passwords are the same
		elseif (strcmp($value[0], $value[1]) != 0) {
			$this->addError('The passwords do not match!', 1221560718);
		}
	}
}

?>