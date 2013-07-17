<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Chantrea\Training\Domain\Model\Location;

/**
 * Location controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class LocationController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\LocationRepository
	 */
	protected $locationRepository;

	/**
	 * Shows a single location object
	 *
	 * @param \Chantrea\Training\Domain\Model\Location $location The location to show
	 * @return void
	 */
	public function showAction(Location $location) {
		$this->view->assign('location', $location);
	}

	/**
	 * Shows a form for creating a new location object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new location object to the location repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Location $newLocation A new location to add
	 * @return void
	 */
	public function createAction(Location $newLocation) {
		$this->locationRepository->add($newLocation);
		$this->addFlashMessage('Created a new location.');
		$this->redirect('administrator', 'Topic');
	}

	/**
	 * Shows a form for editing an existing location object
	 *
	 * @param \Chantrea\Training\Domain\Model\Location $location The location to edit
	 * @return void
	 */
	public function editAction(Location $location) {
		$this->view->assign('location', $location);
	}

	/**
	 * Updates the given location object
	 *
	 * @param \Chantrea\Training\Domain\Model\Location $location The location to update
	 * @return void
	 */
	public function updateAction(Location $location) {
		$this->locationRepository->update($location);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Updated the location.');
		$this->redirect('administrator', 'Topic');
	}

	/**
	 * Removes the given location object from the location repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Location $location The location to delete
	 * @return void
	 */
	public function deleteAction(Location $location) {
		$this->locationRepository->remove($location);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Deleted a location.');
		$this->redirect('administrator', 'Topic');
	}

}

?>