<?php
namespace Chantrea\Training\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Account command controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class AccountCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountFactory
	 */
	protected $accountFactory;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Party\Domain\Repository\PartyRepository
	 */
	protected $partyRepository;

	/**
	 * Name of the authentication provider to be used.
	 *
	 * @var string
	 */
	protected $authenticationProviderName = 'DefaultProvider';


	/**
	 * Command to create an account
	 *
	 * The account is at the moment only available to create using the command line since the registering through
	 * Web Interface is not done yet.
	 *
	 * Please apply the correct parameters as in the Usage and Arguments section above
	 *
	 * @param string $identifier The account's identifier
	 * @param string $password The account's password
	 * @param string $firstName The account's first name
	 * @param string $lastName The account's last name
	 * @param boolean $admin If enable, grant admin access
	 * @return void
	 */
	public function createCommand($identifier, $password, $firstName, $lastName, $admin = FALSE) {
		// Check if the account already exists
		$existingAccount = $this->accountRepository->findActiveByAccountIdentifierAndAuthenticationProviderName($identifier, $this->authenticationProviderName);
		if ($existingAccount) {
			$this->outputLine('FAILED! Account "' . $identifier . '" already exists!');
			return;
		}

		$user = new \Chantrea\Training\Domain\Model\User();
		$user->setName(new \TYPO3\Party\Domain\Model\PersonName('', $firstName, '', $lastName));

		$roleIdentifiers = array();
		if ($admin === TRUE) {
			$roleIdentifiers[] = 'Chantrea.Training:Administrator';
		} else {
			$roleIdentifiers[] = 'Chantrea.Training:User';
		}

		$account = $this->accountFactory->createAccountWithPassword($identifier, $password, $roleIdentifiers);
		$this->accountRepository->add($account);
		$user->addAccount($account);

		$this->partyRepository->add($user);

		$this->outputLine('New account "%s" has been created.', array($identifier));
	}
}

?>