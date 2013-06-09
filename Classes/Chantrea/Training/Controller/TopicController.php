<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use Chantrea\Training\Domain\Model\Topic;

/**
 * Topic controller for the Chantrea.Training package
 *
 * @Flow\Scope("singleton")
 */
class TopicController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\TopicRepository
	 */
	protected $topicRepository;

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\CategoryRepository
	 */
	protected $categoryRepository;
	
	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\StatusRepository
	 */
	protected $statusRepository;

	/**
	 * Shows a list of topics
	 *
	 * @return void
	 * @Flow\SkipCsrfProtection
	 */
	public function indexAction() {
		$this->view->assign('topics', $this->topicRepository->findAll());
		$this->view->assign('acceptedTopics', $this->topicRepository->findAcceptedTopic());
		$this->view->assign('scheduleTopics', $this->topicRepository->findScheduleTopic());
		$this->view->assign('suggestedTopics', $this->topicRepository->findSuggestedTopic());
	}

	/**
	 * Shows a single topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to show
	 * @return void
	 * @Flow\SkipCsrfProtection
	 */
	public function showAction(Topic $topic) {
		$this->view->assign('topic', $topic);
	}

	/**
	 * Shows a list of suggest topics
	 *
	 * @return void
	 * @Flow\SkipCsrfProtection
	 */
	public function suggestAction () {
		$this->view->assign('suggestedTopics', $this->topicRepository->findSuggestedTopic());
	}

	/**
	 * Shows a form for creating a new topic object
	 *
	 * @return void
	 * @Flow\SkipCsrfProtection
	 */
	public function newAction() {
		$this->view->assign('account', $this->securityContext->getAccount());
		$this->view->assign('category', $this->categoryRepository->findAll());
	}

	/**
	 * Adds the given new topic object to the topic repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $newTopic A new topic to add
	 * @return void
	 */
	public function createAction(Topic $newTopic) {
		$newTopic->setAccount($this->securityContext->getAccount());
		//$newTopic->setStatus();
		$this->topicRepository->add($newTopic);
		$this->addFlashMessage('Created a new topic.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to edit
	 * @return void
	 * @Flow\SkipCsrfProtection
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

	/**
	 * Redirect action
	 *
	 * @return void
	 */
	public function redirectAction() {
		$this->redirect('index');
	}

	/**
	 * Update status of topic
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $suggestedTopic The topic to update
	 * @return void
	 * @Flow\SkipCsrfProtection
	 */
	/*public function acceptedAction(Topic $suggestedTopic) {
		//debug($suggestedTopic);exit();
		$suggestedTopic->setStatus('2');
		$this->topicRepository->update($suggestedTopic);
		$this->redirect('suggested');
	}*/
}

?>