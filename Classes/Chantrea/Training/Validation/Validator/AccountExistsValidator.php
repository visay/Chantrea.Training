<?php
namespace Chantrea\Training\Validation\Validator;

/*                                                                    *
 * This script belongs to the package "Chantrea.Training".            *
 *                                                                    */

use TYPO3\Flow\Annotations as Flow;

/**
 * Account exists validator for the Chantrea.Training package
 * Checks the account if it has ready in account repository
 */
class AccountExistsValidator extends \TYPO3\Flow\Validation\Validator\AbstractValidator {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * Check if $value is valid. If it is not valid, needs to add an error
	 * to Result.
	 *
	 * @param string $value Value
	 *
	 * @return void
	 */
	protected function isValid($value) {
		$account = $this->accountRepository->findActiveByAccountIdentifierAndAuthenticationProviderName($value, 'DefaultProvider');
		if ($account && $account->getAccountIdentifier() == $value) {
			$this->addError('This username already exists.', 1221560718);
		}
	}
}

?>