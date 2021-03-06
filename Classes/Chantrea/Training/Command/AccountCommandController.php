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
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * @Flow\Inject
	 * @var TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * Name of the authentication provider to be used.
	 *
	 * @var string
	 */
	protected $defaultProvider = 'DefaultProvider';

	/**
	 * Name of the authentication provider to be used.
	 *
	 * @var string
	 */
	protected $ldapProvider = 'LdapProvider';

	/**
	 * Command to create an account with default provider
	 *
	 * This command create an account as an alternative to registering through
	 * Web Interface. This is the only way at the moment to create account with
	 * admin access.
	 *
	 * Please apply the correct parameters as in the Usage and Arguments section above
	 *
	 * @param string $username The account's username
	 * @param string $password The account's password
	 * @param string $firstName The account's first name
	 * @param string $lastName The account's last name
	 * @param string $email The account's email address
	 * @param boolean $admin If enable, grant admin access
	 *
	 * @return void
	 */
	public function createCommand($username, $password, $firstName, $lastName, $email, $admin = FALSE) {
		// Check if the account already exists in default provider
		$existingAccount = $this->accountRepository->findActiveByAccountIdentifierAndAuthenticationProviderName($username, $this->defaultProvider);
		// If account doesn't exist in default provider, continue to check in ldap provider
		if (! $existingAccount) {
			$existingAccount = $this->accountRepository->findActiveByAccountIdentifierAndAuthenticationProviderName($username, $this->ldapProvider);
		}
		// Doesn't do anything if account exists
		if ($existingAccount) {
			$this->outputLine('FAILED: Account "' . $username . '" already exists!');
			return;
		}
		// Validate email address
		if (! $this->validEmail($email)) {
			$this->outputLine('FAILED: Please specify a valid email address.');
			return;
		}
		// Check if the email address already in use
		$userEmailExist = $this->userRepository->findByEmail($email);
		if ($userEmailExist) {
			$this->outputLine('FAILED: Email address "' . $email . '" already exists in the system.');
			return;
		}
		// Check for password length
		$minimumLength = 5;
		if (strlen($password) < $minimumLength) {
			$this->outputLine('FAILED: The minimum password length must be ' . $minimumLength . '.');
			return;
		}
		// Everything is fine, create an account with default provider
		$user = new \Chantrea\Training\Domain\Model\User();
		$user->setName(new \TYPO3\Party\Domain\Model\PersonName('', $firstName, '', $lastName));
		$user->setEmail($email);

		$roleIdentifiers = array();
		if ($admin === TRUE) {
			$roleIdentifiers[] = 'Chantrea.Training:Administrator';
		} else {
			$roleIdentifiers[] = 'Chantrea.Training:User';
		}

		$account = $this->accountFactory->createAccountWithPassword($username, $password, $roleIdentifiers, $this->defaultProvider);
		$this->accountRepository->add($account);
		$user->addAccount($account);

		$this->partyRepository->add($user);

		$this->outputLine('New account "%s" has been created.', array($username));
	}

	/**
	 * Command to remove an account from default provider
	 *
	 * This command remove an account from the database by searching for the username applied.
	 * Come with a confirmation message to reduce common mistake.
	 *
	 * @param string $username The account's username
	 *
	 * @return void
	 */
	public function removeCommand($username) {
		// Check if the account exists
		$existingAccount = $this->accountRepository->findActiveByAccountIdentifierAndAuthenticationProviderName($username, $this->defaultProvider);
		if (! $existingAccount) {
			$this->outputLine('FAILED: Account "' . $username . '" does not exist!');
			return;
		}

		if ($this->confirm('Are you sure you want to remove account "' . $username . '"? (Y/n): ')) {
			try {
				$this->accountRepository->remove($existingAccount);
				$this->partyRepository->remove($existingAccount->getParty());
				$this->persistenceManager->persistAll();
				$this->outputLine('Account "%s" has been removed.', array($username));
			} catch (\Exception $exception) {
				$this->outputLine('FAILED: Account "%s" is associated with training topics and cannot be removed!', array($username));
			}
		} else {
			$this->outputLine('Aborted!');
		}
	}

	/**
	 * Command to list all accounts
	 *
	 * This command lists all accounts from the database with some useful information.
	 *
	 * @return void
	 */
	public function listCommand() {
		$accounts = $this->accountRepository->findAll();
		foreach ($accounts as $account) {
			$this->outputLine('- ' . $account->getAccountIdentifier() . ' | ' . $account->getParty()->getName() .
				' | ' . $account->getParty()->getEmail() . ' | ' . (in_array('Chantrea.Training:Administrator', $account->getRoles()) ?
				'Administrator' : 'User') . ' | ' . $account->getAuthenticationProviderName());
		}
	}

	/**
	 * Checking syntax of input email address
	 *
	 * @param string $emailAddress Input string to evaluate
	 * @return boolean Returns TRUE if the $email address (input string) is valid
	 */
	private function validEmail($emailAddress) {
		// Enforce maximum length to prevent libpcre recursion crash bug #52929 in PHP
		// fixed in PHP 5.3.4; length restriction per SMTP RFC 2821
		if (strlen($emailAddress) > 320) {
			return FALSE;
		}

		return (filter_var($emailAddress, FILTER_VALIDATE_EMAIL) !== FALSE);
	}

	/**
	 * Confirm message in command line action
	 *
	 * @param string $message The message
	 *
	 * @return boolean
	 */
	private function confirm($message) {
		print($message);
		$response = (string)fgets(STDIN);
		if (strcmp(trim($response), 'Y') == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

?>