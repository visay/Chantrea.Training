<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Login controller for the Chantrea.Training package 
 *
 * @Flow\Scope("singleton")
 */
class LoginController extends \TYPO3\Flow\Mvc\Controller\ActionController {
	
	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 */
	protected $authenticationManager;
	
	/**
	 * @Flow\Inject
	 * @var TYPO3\Flow\Security\Context
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
	 * Authenticates an account by invoking the Provider based Authentication Manager.
	 *
	 * On successful authentication redirects to the list of posts, otherwise returns
	 * to the login screen.
	 *
	 * @return void
	 * @author កែវ វិស័យ <visay@typo3cambodia.org>
	 */
	public function authenticateAction() {
		try {
			$this->authenticationManager->authenticate();
			$this->redirect('index', 'Training');
		} catch (\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception) {
			$this->addFlashMessage('ឈ្មោះអ្នកប្រើប្រាស់ ឬក៏ លេខសម្ងាត់ ពុំត្រឹមត្រូវ។');
			throw $exception;
		}
	}
}
?>