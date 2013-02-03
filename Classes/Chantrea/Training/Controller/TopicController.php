<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Chantrea\Training\Domain\Model\Topic;

/**
 * Topic controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class TopicController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\TopicRepository
	 */
	protected $topicRepository;

	/**
	 * Shows a list of topics
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('topics', $this->topicRepository->findAll());
	}

	/**
	 * Shows a single topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to show
	 * @return void
	 */
	public function showAction(Topic $topic) {
		$this->view->assign('topic', $topic);
	}

	/**
	 * Shows a form for creating a new topic object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new topic object to the topic repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $newTopic A new topic to add
	 * @return void
	 */
	public function createAction(Topic $newTopic) {
		$this->topicRepository->add($newTopic);
		$this->addFlashMessage('Created a new topic.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to edit
	 * @return void
	 */
	public function editAction(Topic $topic) {
		$this->view->assign('topic', $topic);
	}

	/**
	 * Updates the given topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to update
	 * @return void
	 */
	public function updateAction(Topic $topic) {
		$this->topicRepository->update($topic);
		$this->addFlashMessage('Updated the topic.');
		$this->redirect('index');
	}

	/**
	 * Removes the given topic object from the topic repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to delete
	 * @return void
	 */
	public function deleteAction(Topic $topic) {
		$this->topicRepository->remove($topic);
		$this->addFlashMessage('Deleted a topic.');
		$this->redirect('index');
	}
}

?>