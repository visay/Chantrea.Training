<?php
namespace Chantrea\Training\Controller;

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
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

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
	 * @deprecated
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
	 * @deprecated
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

			// TODO: read email from constant and render body from view
			$mail = new \TYPO3\SwiftMailer\Message();
			$mail->setFrom(array('noreply@visay.info' => 'Chantrea Training'))
				->setTo(array($email => $user->getName()))
				->setSubject('Account Creation')
				->setFormat('html')
				->setBody('Dear ' . $user->getName() . ',<br/><br/>Your account "' . $username .
					'" has been created.<br/><br/>Best regards,<br/>Chantrea Training Team', 'text/html');
			$mail->send();

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
	 */
	public function authenticateAction() {
		$authenticated = FALSE;
		try {
			$this->authenticationManager->authenticate();
			$authenticated = TRUE;
		} catch(\Exception $exception) {
			$message = $exception->getMessage();
		}

		if ($authenticated) {
			$roles = $this->securityContext->getAccount()->getRoles();
			foreach ($roles as $role) {
				if ($role == 'Chantrea.Training:Administrator') {
					$this->redirect('administrator', 'Topic');
				}
			}
			$this->redirect('index', 'Topic');
		} else {
			$this->addFlashMessage('Incorrect username or password.', '', Message::SEVERITY_ERROR);
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

	/**
	 * Show contact form action
	 *
	 * @param \Chantrea\Training\Domain\Model\User $user session
	 * @return Void
	 */
	public function showContactAction($user = NULL) {
		$this->view->assign('sessionUser', $user);
	}

	/**
	 * Send Contact action
	 *
	 * @param string  $firstName  The first name
	 * @param string  $lastName   The last name
	 * @param string  $email      The email address
	 * @param string   $orgCompany   The organization / company
	 * @param string   $message   The message
	 *
	 * @Flow\Validate(argumentName="firstName", type="NotEmpty")
	 * @Flow\Validate(argumentName="lastName", type="NotEmpty")
	 *
	 * @Flow\Validate(argumentName="email", type="NotEmpty")
	 * @Flow\Validate(argumentName="email", type="EmailAddress")
	* @Flow\Validate(argumentName="message", type="NotEmpty")
	 *
	 * @return void
	 */
	public function sendContactAction($firstName, $lastName, $email, $orgCompany, $message) {
		// TODO: read email from constant and render body from view
		$mail = new \TYPO3\SwiftMailer\Message();
		for ($i = 1; $i <= count($this->settings['adminEmails']); $i++) {
			$adminEmail = $this->settings['adminEmails']['contact' . $i . ''];
			$adminName = $this->settings['adminNames']['contact' . $i . ''];
			$msg = 'Dear ' . $adminName . ',<br/><br/>';
			$msg .= 'You have recieved contact request on Chantrea Training with the following information: <br/><br/>';
			$msg .= '<table>';
			$msg .= '<tr><td><strong>First Name:</strong></td><td> ' . $firstName . '<br/></td></tr>';
			$msg .= '<tr><td><strong>Last Name:</strong></td><td> ' . $lastName . '<br/></td></tr>';
			$msg .= '<tr><td><strong>Email:</strong></td><td> ' . $email . '<br/></td></tr>';
			$msg .= '<tr><td><strong>Organization / Company:</strong></td><td> ' . $orgCompany . '<br/></td></tr>';
			$msg .= '<tr><td><strong>Message:</strong></td><td> ' . $message . '<br/></td></tr>';
			$mail->setFrom(array($email => $firstName . ' ' . $lastName))
				->setTo(array($adminEmail => $adminName))
				->setSubject('New Contact on Chantrea Training')
				->setFormat('html')
				->setBody($msg, 'text/html');
			$mail->send();
		}
		$this->addFlashMessage('Your message has been sent successfully.');
		$this->redirect('showContact');
	}
}

?>