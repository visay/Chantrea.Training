<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Chantrea.Training".          *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\MVC\Controller\ActionController;
use \Chantrea\Training\Domain\Model\Training;

/**
 * Training controller for the Chantrea.Training package 
 *
 * @FLOW3\Scope("singleton")
 */
class TrainingController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \Chantrea\Training\Domain\Repository\TrainingRepository
	 */
	protected $trainingRepository;
	
	/**
	 * @FLOW3\Inject
	 * @var \Chantrea\Training\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * Shows a list of trainings
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('trainings', $this->trainingRepository->findAll());
	}

	/**
	 * Shows a single training object
	 *
	 * @param \Chantrea\Training\Domain\Model\Training $training The training to show
	 * @return void
	 */
	public function showAction(Training $training) {
		$this->view->assign('training', $training);
	}

	/**
	 * Shows a form for creating a new training object
	 *
	 * @return void
	 */
	public function newAction() {
		$this->view->assign('users', $this->userRepository->findAll());
	}

	/**
	 * Adds the given new training object to the training repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Training $training A new training to add
	 * @return void
	 */
	public function createAction(\Chantrea\Training\Domain\Model\Training $newTraining) {
		$newTraining->setVote(0);
		$this->trainingRepository->add($newTraining);
		$this->addFlashMessage('Created a new training.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing training object
	 *
	 * @param \Chantrea\Training\Domain\Model\Training $training The training to edit
	 * @return void
	 */
	public function editAction(Training $training) {
		$this->view->assign('training', $training);
	}

	/**
	 * Updates the given training object
	 *
	 * @param \Chantrea\Training\Domain\Model\Training $training The training to update
	 * @return void
	 */
	public function updateAction(Training $training) {
		$this->trainingRepository->update($training);
		$this->addFlashMessage('Updated the training.');
		$this->redirect('index');
	}

	/**
	 * Removes the given training object from the training repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Training $training The training to delete
	 * @return void
	 */
	public function deleteAction(Training $training) {
		$this->trainingRepository->remove($training);
		$this->addFlashMessage('Deleted a training.');
		$this->redirect('index');
	}
	
	/**
	 * Voted the given training object
	 *
	 * @param \Chantrea\Training\Domain\Model\Training $training The training to update
	 * @return void
	 */
	public function voteAction(Training $training) {
		$training->setVote($training->getVote() + 1);
		$this->trainingRepository->update($training);
		$this->addFlashMessage('Voted the training.');
		$this->redirect('index');
	}

}

?>