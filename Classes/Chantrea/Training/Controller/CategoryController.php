<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Chantrea\Training\Domain\Model\Category;

/**
 * Category controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class CategoryController extends ActionController {

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
	 * Shows a single category object
	 *
	 * @param \Chantrea\Training\Domain\Model\Category $category The category to show
	 * @return void
	 */
	public function showAction(Category $category) {
		$this->view->assign('category', $category);
	}

	/**
	 * Shows a form for creating a new category object
	 *
	 * @return void
	 */
	public function newAction() {

	}

	/**
	 * Adds the given new category object to the category repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Category $newCategory A new category to add
	 * @Flow\Validate(argumentName="$newCategory", type="UniqueEntity", options={"identityProperties"={"name"}})
	 * @return void
	 */
	public function createAction(Category $newCategory) {
		$this->categoryRepository->add($newCategory);
		$this->addFlashMessage('Created a new category.');
		$this->redirect('administrator', 'Topic');
	}

	/**
	 * Shows a form for editing an existing category object
	 *
	 * @param \Chantrea\Training\Domain\Model\Category $category The category to edit
	 * @return void
	 */
	public function editAction(Category $category) {
		$this->view->assign('category', $category);
	}

	/**
	 * Updates the given category object
	 *
	 * @param \Chantrea\Training\Domain\Model\Category $category The category to update
	 * @Flow\Validate(argumentName="$category", type="UniqueEntity", options={"identityProperties"={"name"}})
	 * @return void
	 */
	public function updateAction(Category $category) {
		$this->categoryRepository->update($category);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Updated the category.');
		$this->redirect('administrator', 'Topic');
	}

	/**
	 * Removes the given category object from the category repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Category $category The category to delete
	 * @return void
	 */
	public function deleteAction(Category $category) {
		$this->categoryRepository->remove($category);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Deleted a category.');
		$this->redirect('administrator', 'Topic');
	}

}

?>