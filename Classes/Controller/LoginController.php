<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Login controller for the Chantrea.Training package 
 *
 * @FLOW3\Scope("singleton")
 */
class LoginController extends \TYPO3\FLOW3\MVC\Controller\ActionController {
	
	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Security\Authentication\AuthenticationManagerInterface
	 */
	protected $authenticationManager;
	
	/**
	 * @FLOW3\Inject
	 * @var TYPO3\FLOW3\Security\Context
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
		} catch (\TYPO3\FLOW3\Security\Exception\AuthenticationRequiredException $exception) {
			$this->addFlashMessage('ឈ្មោះអ្នកប្រើប្រាស់ ឬក៏ លេខសម្ងាត់ ពុំត្រឹមត្រូវ។');
			throw $exception;
		}
	}
}
?>