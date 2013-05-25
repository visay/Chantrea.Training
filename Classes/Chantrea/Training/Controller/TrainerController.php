<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Chantrea\Training\Domain\Model\Trainer;

/**
 * Trainer controller for the Chantrea.Training package 
 *
 * @Flow\Scope("singleton")
 */
class TrainerController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\TrainerRepository
	 */
	protected $trainerRepository;

	/**
	 * Shows a list of trainers
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('trainers', $this->trainerRepository->findAll());
	}

	/**
	 * Shows a single trainer object
	 *
	 * @param \Chantrea\Training\Domain\Model\Trainer $trainer The trainer to show
	 * @return void
	 */
	public function showAction(Trainer $trainer) {
		$this->view->assign('trainer', $trainer);
	}

	/**
	 * Shows a form for creating a new trainer object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new trainer object to the trainer repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Trainer $newTrainer A new trainer to add
	 * @return void
	 */
	public function createAction(Trainer $newTrainer) {
		$this->trainerRepository->add($newTrainer);
		$this->addFlashMessage('Created a new trainer.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing trainer object
	 *
	 * @param \Chantrea\Training\Domain\Model\Trainer $trainer The trainer to edit
	 * @return void
	 */
	public function editAction(Trainer $trainer) {
		$this->view->assign('trainer', $trainer);
	}

	/**
	 * Updates the given trainer object
	 *
	 * @param \Chantrea\Training\Domain\Model\Trainer $trainer The trainer to update
	 * @return void
	 */
	public function updateAction(Trainer $trainer) {
		$this->trainerRepository->update($trainer);
		$this->addFlashMessage('Updated the trainer.');
		$this->redirect('index');
	}

	/**
	 * Removes the given trainer object from the trainer repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Trainer $trainer The trainer to delete
	 * @return void
	 */
	public function deleteAction(Trainer $trainer) {
		$this->trainerRepository->remove($trainer);
		$this->addFlashMessage('Deleted a trainer.');
		$this->redirect('index');
	}

}

?>