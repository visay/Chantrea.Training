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
class EmailExistsValidator extends \TYPO3\Flow\Validation\Validator\AbstractValidator {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * Check if $value is valid. If it is not valid, needs to add an error
	 *
	 * @param string $value Value
	 *
	 * @return void
	 */
	protected function isValid($value) {
		$user = $this->userRepository->findByEmail($value);
		if ($user) {
			$this->addError('Email address already exists in the system.', 1221560718);
		}
	}
}

?>