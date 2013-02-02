<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Standard controller for the Chantrea.Training package 
 *
 * @Flow\Scope("singleton")
 */
class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;
	
	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountFactory
	 */
	protected $accountFactory;
	
	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 */
	protected $authenticationManager;
	
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
		} catch (\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception) {
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
		$this->addFlashMessage('Successfully logged out.');
		$this->redirect('index');
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
	
	/**
	 * Enter description here ...
	 */
	public function signupAction() {
		
	}

}

?>