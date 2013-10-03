<?php
namespace Chantrea\Training\Security\Authentication\Provider;

/*                                                                        *
 * This script belongs to the Flow package "TYPO3.LDAP".                  *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * LDAP Authentication provider
 *
 * @Flow\Scope("prototype")
 */
class LDAPProvider extends \TYPO3\LDAP\Security\Authentication\Provider\LDAPProvider {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Party\Domain\Repository\PartyRepository
	 */
	protected $partyRepository;

	/**
	 * Create a new party for a user's first login
	 * Extend this Provider class and implement this method to create a party
	 *
	 * @param \TYPO3\Flow\Security\Account $account The freshly created account that should be used for this party
	 * @param array $ldapSearchResult The first result returned by ldap_search
	 * @return void
	 */
	protected function createParty(\TYPO3\Flow\Security\Account $account, array $ldapSearchResult) {
		$user = new \Chantrea\Training\Domain\Model\User();
		$user->setName(new \TYPO3\Party\Domain\Model\PersonName('', $ldapSearchResult['givenname'][0], '', $ldapSearchResult['sn'][0]));
		$user->setEmail($ldapSearchResult['mail'][0]);
		$user->addAccount($account);
		$this->partyRepository->add($user);
	}
}

?>