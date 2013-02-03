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
	 * @return void
	 */
	public function createCommand($identifier, $password, $firstName, $lastName) {
		$person = new \TYPO3\Party\Domain\Model\Person();
		$person->setName(new \TYPO3\Party\Domain\Model\PersonName('', $firstName, '', $lastName));

		$electronicAddress = new \TYPO3\Party\Domain\Model\ElectronicAddress();
		$electronicAddress->setType(\TYPO3\Party\Domain\Model\ElectronicAddress::TYPE_EMAIL);
		$electronicAddress->setIdentifier($identifier);
		$person->setPrimaryElectronicAddress($electronicAddress);

		$account = $this->accountFactory->createAccountWithPassword($identifier, $password, array('Administrator'));
		$this->accountRepository->add($account);
		$person->addAccount($account);
		$this->partyRepository->add($person);

		$this->outputLine('New account "%s" has been created.', array($identifier));
	}
}

?>