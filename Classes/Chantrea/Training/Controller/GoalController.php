<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class GoalController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\GoalRepository
	 */
	protected $goalRepository;

	/**
	 * Initializes the view before invoking an action method.
	 *
	 * @param \TYPO3\Flow\Mvc\View\ViewInterface $view The view to be initialized
	 *
	 * @return void
	 */
	protected function initializeView(\TYPO3\Flow\Mvc\View\ViewInterface $view) {
		$view->assign('sessionUser', $this->securityContext->getAccount()->getParty());
	}

	/**
	 * Shows a form for creating a new goal object
	 *
	 * @return void
	 */
	public function newAction() {
		$this->view->assign('years', $this->settings['yearOptions']);

	}

	/**
	 * Adds the given new goal object to the goal repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Goal $Goal A new goal to add
	 *
	 * @return void
	 */
	public function createAction($newGoal) {
		$newGoal->setOwner($this->securityContext->getAccount()->getParty());
		$this->goalRepository->add($newGoal);
		$this->addFlashMessage('Created a new goal.');
		$this->redirect('index', 'Topic');
	}

	/**
	 * Shows a form for editing an existing goal object
	 *
	 * @param \Chantrea\Training\Domain\Model\Goal $goal The goal to edit
	 *
	 * @return void
	 */
	public function editAction($goal) {
		$this->view->assign('goal', $goal);
		$this->view->assign('years', $this->settings['yearOptions']);
	}

	/**
	 * Update action
	 * @return void
	 */
	public function updateAction($goal) {
		$this->goalRepository->update($goal);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Updated the goal.');
		$this->redirect('index');
	}

	/**
	 * Removes the given goal object from the goal repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Goal $goal The goal to delete
	 *
	 * @return void
	 */
	public function deleteAction(Goal $goal) {
		$this->topicRepository->remove($goal);
		$this->addFlashMessage('Deleted a topic.');
		$this->persistenceManager->persistAll();
		$this->redirect('index', 'Topic');
	}

}

?>