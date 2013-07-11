<?php
namespace Chantrea\Training\Controller;

use TYPO3\Flow\Aop\Exception\VoidImplementationException;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Error\Message;
/**
 * Standard controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController {

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
		if ($this->authenticationManager->isAuthenticated()) {
			$this->redirect('index', 'Topic');
		} else {
			$this->view->assign('login', TRUE);
		}
	}

	/**
	 * Redirect action
	 *
	 * @return void
	 */
	public function redirectAction() {
		$this->redirect('index');
	}

	/**
	 * Authenticate action
	 *
	 * @return void
	 * @throws \TYPO3\Flow\Security\Exception
	 */
	public function authenticateAction() {
		try {
			$this->authenticationManager->authenticate();
			$this->redirect('index', 'Topic');
		} catch(\TYPO3\Flow\Security\Exception $exception) {
			$this->addFlashMessage('Incorrect username or password.', '', Message::SEVERITY_ERROR);
			throw $exception;
		}
	}

	/**
	 * Logout action
	 *
	 * @return void
	 */
	public function logoutAction() {
		$this->authenticationManager->logout();
		$this->addFlashMessage('Successfully logged out!');
		$this->redirect('index');
	}

	/**
	 * Show account action
	 *
	 * @param \TYPO3\Flow\Security\Account $account
	 *
	 * @return Void
	 */
	public function showAccountAction(Account $account) {
		$this->view->assign('account', $account);
	}
}

?>