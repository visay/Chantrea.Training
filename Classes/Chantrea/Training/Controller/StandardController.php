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
	 * Index/login action
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
	 * Register action
	 *
	 * @return void
	 */
	public function registerAction() {
		if ($this->authenticationManager->isAuthenticated()) {
			$this->redirect('index', 'Topic');
		} else {
			$this->view->assign('login', TRUE);
		}
	}

	/**
	 * Create a new user action
	 *
	 * @param string  $username   The username
	 * @param string  $firstName  The first name
	 * @param string  $lastName   The last name
	 * @param string  $email      The email address
	 * @param array   $password   The password
	 *
	 * @Flow\Validate(argumentName="username", type="NotEmpty")
	 * @Flow\Validate(argumentName="username", type="StringLength", options={"minimum"=3, "maximum"=25})
	 * @Flow\Validate(argumentName="username", type="Chantrea.Training:AccountExists")
	 *
	 * @Flow\Validate(argumentName="firstName", type="NotEmpty")
	 * @Flow\Validate(argumentName="lastName", type="NotEmpty")
	 *
	 * @Flow\Validate(argumentName="email", type="NotEmpty")
	 * @Flow\Validate(argumentName="email", type="EmailAddress")
	 * @Flow\Validate(argumentName="email", type="Chantrea.Training:EmailExists")
	 *
	 * @Flow\Validate(argumentName="password", type="Chantrea.Training:Password", options={"minimumLength"=5})
	 *
	 * @return void
	 */
	public function createAction($username, $firstName, $lastName, $email, $password) {
		if ($this->authenticationManager->isAuthenticated()) {
			$this->redirect('index', 'Topic');
		} else {
			$user = new \Chantrea\Training\Domain\Model\User();
			$user->setName(new \TYPO3\Party\Domain\Model\PersonName('', $firstName, '', $lastName));
			$user->setEmail($email);

			$account = $this->accountFactory->createAccountWithPassword($username, $password[0], array('Chantrea.Training:User'));
			$this->accountRepository->add($account);
			$user->addAccount($account);

			$this->partyRepository->add($user);
			$this->addFlashMessage('Your account has been created successfully.');
			$this->redirect('index');
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