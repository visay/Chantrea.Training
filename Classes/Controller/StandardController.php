<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Standard controller for the Chantrea.Training package 
 *
 * @FLOW3\Scope("singleton")
 */
class StandardController extends \TYPO3\FLOW3\MVC\Controller\ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Security\AccountRepository
	 */
	protected $accountRepository;
	
	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Security\AccountFactory
	 */
	protected $accountFactory;
	
	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Security\Authentication\AuthenticationManagerInterface
	 */
	protected $authenticationManager;
	
	/**
	 * @var \TYPO3\FLOW3\Security\Context
	 * @FLOW3\Inject
	 */
	protected $securityContext;
	
	/**
	 * Index action
	 *
	 * @return void
	 */
	public function indexAction() {

	}
	
	/**
	 * Authenticate username and password
	 * 
	 * @return void
	 */
	public function authenticateAction() {
		try {
			$this->authenticationManager->authenticate();
			$this->redirect('index', 'Training');
		} catch (\TYPO3\FLOW3\Security\Exception\AuthenticationRequiredException $exception) {
			$this->addFlashMessage('Wrong username or password.');
			$this->redirect('index');
		}
	}
	
	/**
	 * Logout action
	 * 
	 * @return void
	 */
	public function logoutAction() {
		$this->authenticationManager->logout();
		$activeTokens = $this->securityContext->getAuthenticationTokens();
		foreach ($activeTokens as $token) {
			if ($token->isAuthenticated()) {
				$token->setAuthenticationStatus($token::NO_CREDENTIALS_GIVEN);
			}
		}
		$this->addFlashMessage('Successfully logged out.');
		$this->redirect('generateDefaultAccount');
	}
	
	/**
	 * Generate default account for login
	 * 
	 * @return void
	 */
	public function generateDefaultAccountAction() {
		$this->accountRepository->removeAll();
		
		$identifier = 'visay';
		$password = '12345';
		$roles = array('Administrator');
		$authenticationProviderName = 'DefaultProvider';
		
		$account = $this->accountFactory->createAccountWithPassword($identifier, $password, $roles, $authenticationProviderName);
		$this->accountRepository->add($account);
		$this->addFlashMessage('Account created! Username: "visay", Password: "12345"!');
		$this->redirect('index');
	}

}

?>