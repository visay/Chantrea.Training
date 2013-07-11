<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Chantrea\Training\Domain\Model\User;

/**
 * User controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class UserController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * Shows a list of users
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('users', $this->userRepository->findAll());
	}

	/**
	 * Shows a single user object
	 *
	 * @param \Chantrea\Training\Domain\Model\User $user The user to show
	 * @return void
	 */
	public function showAction(User $user) {
		$this->view->assign('user', $user);
	}

	/**
	 * Shows a form for creating a new user object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new user object to the user repository
	 *
	 * @param \Chantrea\Training\Domain\Model\User $newUser A new user to add
	 * @return void
	 */
	public function createAction(User $newUser) {
		$this->userRepository->add($newUser);
		$this->addFlashMessage('Created a new user.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing user object
	 *
	 * @param \Chantrea\Training\Domain\Model\User $user The user to edit
	 * @return void
	 */
	public function editAction(User $user) {
		$this->view->assign('user', $user);
	}

	/**
	 * Updates the given user object
	 *
	 * @param \Chantrea\Training\Domain\Model\User $user The user to update
	 * @return void
	 */
	public function updateAction(User $user) {
		$this->userRepository->update($user);
		$this->addFlashMessage('Updated the user.');
		$this->redirect('index');
	}

	/**
	 * Removes the given user object from the user repository
	 *
	 * @param \Chantrea\Training\Domain\Model\User $user The user to delete
	 * @return void
	 */
	public function deleteAction(User $user) {
		$this->userRepository->remove($user);
		$this->addFlashMessage('Deleted a user.');
		$this->redirect('index');
	}

}

?>