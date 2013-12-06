<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Chantrea\Training\Domain\Model\Type;

/**
 * Type controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class TypeController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\TypeRepository
	 */
	protected $typeRepository;

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
	 * Shows a single type object
	 *
	 * @param \Chantrea\Training\Domain\Model\Type $type The type to show
	 *
	 * @return void
	 */
	public function showAction(Type $type) {
		$this->view->assign('type', $type);
	}

	/**
	 * Shows a form for creating a new type object
	 *
	 * @return void
	 */
	public function newAction() {

	}

	/**
	 * Adds the given new type object to the type repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Type $newType A new type to add
	 * @Flow\Validate(argumentName="$newType", type="UniqueEntity", options={"identityProperties"={"name"}})
	 *
	 * @return void
	 */
	public function createAction(Type $newType) {
		$this->typeRepository->add($newType);
		$this->addFlashMessage('Created a new type.');
		$this->redirect('administrator', 'Topic');
	}

	/**
	 * Shows a form for editing an existing type object
	 *
	 * @param \Chantrea\Training\Domain\Model\Type $type The type to edit
	 *
	 * @return void
	 */
	public function editAction(Type $type) {
		$this->view->assign('type', $type);
	}

	/**
	 * Updates the given type object
	 *
	 * @param \Chantrea\Training\Domain\Model\Type $type The type to update
	 * @Flow\Validate(argumentName="$type", type="UniqueEntity", options={"identityProperties"={"name"}})
	 *
	 * @return void
	 */
	public function updateAction(Type $type) {
		$this->typeRepository->update($type);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Updated the type.');
		$this->redirect('administrator', 'Topic');
	}

	/**
	 * Removes the given type object from the type repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Type $type The type to delete
	 *
	 * @return void
	 */
	public function deleteAction(Type $type) {
		$this->typeRepository->remove($type);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Deleted a type.');
		$this->redirect('administrator', 'Topic');
	}

}

?>