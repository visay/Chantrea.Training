<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Chantrea\Training\Domain\Model\Level;

/**
 * Level controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class LevelController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\LevelRepository
	 */
	protected $levelRepository;

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

	/**
	 * Shows a single level object
	 *
	 * @param \Chantrea\Training\Domain\Model\Level $level The level to show
	 *
	 * @return void
	 */
	public function showAction(Level $level) {
		$this->view->assign('level', $level);
	}

	/**
	 * Shows a form for creating a new level object
	 *
	 * @return void
	 */
	public function newAction() {

	}

	/**
	 * Adds the given new level object to the level repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Level $newLevel A new level to add
	 *
	 * @return void
	 */
	public function createAction(Level $newLevel) {
		$this->levelRepository->add($newLevel);
		$this->addFlashMessage('Created a new level.');
		$this->redirect('administrator', 'Topic');
	}

	/**
	 * Shows a form for editing an existing level object
	 *
	 * @param \Chantrea\Training\Domain\Model\Level $level The level to edit
	 *
	 * @return void
	 */
	public function editAction(Level $level) {
		$this->view->assign('level', $level);
	}

	/**
	 * Updates the given level object
	 *
	 * @param \Chantrea\Training\Domain\Model\Level $level The level to update
	 *
	 * @return void
	 */
	public function updateAction(Level $level) {
		$this->levelRepository->update($level);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Updated the level.');
		$this->redirect('administrator', 'Topic');
	}

	/**
	 * Removes the given level object from the level repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Level $level The level to delete
	 *
	 * @return void
	 */
	public function deleteAction(Level $level) {
		$this->levelRepository->remove($level);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Deleted a level.');
		$this->redirect('administrator', 'Topic');
	}

}

?>