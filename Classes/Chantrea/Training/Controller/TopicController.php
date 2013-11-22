<?php
namespace Chantrea\Training\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\I18n\Utility_Original;

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
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

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
	 * @var \Chantrea\Training\Domain\Repository\UserRepository
	 */
	protected $userRepository;

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\LocationRepository
	 */
	protected $locationRepository;

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\TypeRepository
	 */
	protected $typeRepository;

	/**
	 * @Flow\Inject
	 * @var \Chantrea\Training\Domain\Repository\LevelRepository
	 */
	protected $levelRepository;

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
	 * Shows a list of topics
	 *
	 * @return void
	 */
	public function indexAction() {
		$loginUser = $this->securityContext->getAccount()->getParty();
		$currentDate = date("Y-m-d H:i:s");
		$this->view->assign('topics', $this->topicRepository->findMostPopular($this->settings['statusOptions']['rejected']));
		$this->view->assign('voteNumber', $this->settings['voteNumber']);
		$this->view->assign('acceptedTopics', $this->topicRepository->findByStatus($this->settings['statusOptions']['accepted'], $this->settings['limit']));
		$this->view->assign('availableTopics', $this->topicRepository->findByStatus($this->settings['statusOptions']['scheduled'], $this->settings['limit'], $currentDate));
		$this->view->assign('suggestedTopics', $this->topicRepository->findByStatus($this->settings['statusOptions']['new'], $this->settings['limit']));
		$this->view->assign('goals', $this->goalRepository->findByUser($loginUser));
		$this->view->assign('loginUser', $loginUser);
		$this->view->assign('currentPage', 'index');
	}

	/**
	 * Shows a single topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to show
	 *
	 * @return void
	 */
	public function showAction(Topic $topic) {
		// test the status of topic to display scheduled or accepted or suggested topics
		if ($topic->getStatus() == $this->settings['statusOptions']['scheduled']) {
			$this->view->assign('scheduledTopic', $topic);
		} else {
			$this->view->assign('suggestedOrAccepted', $topic);
		}
		// display topic title
		$this->view->assign('topic', $topic);
	}

	/**
	 * Shows a list of suggest topics
	 *
	 * @return void
	 */
	public function suggestAction() {
		$loginUser = $this->securityContext->getAccount()->getParty();
		$suggestedTopics = $this->topicRepository->findByStatus($this->settings['statusOptions']['new']);
		$this->view->assign('suggestedTopics', $suggestedTopics);
		$this->view->assign('loginUser', $loginUser);
		$this->view->assign('currentPage', 'suggested');
	}

	/**
	 * Shows a form for creating a new topic object
	 *
	 * @return void
	 */
	public function newAction() {
		$this->view->assign('owner', $this->securityContext->getAccount()->getParty());
		$this->view->assign('categories', $this->categoryRepository->findAll());
		$this->view->assign('types', $this->typeRepository->findAll());
		$this->view->assign('levels', $this->levelRepository->findAll());
	}

	/**
	 * Adds the given new topic object to the topic repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $newTopic A new topic to add
	 *
	 * @return void
	 */
	public function createAction(Topic $newTopic) {
		$newTopic->setOwner($this->securityContext->getAccount()->getParty());
		$newTopic->setStatus($this->settings['statusOptions']['new']);
		$this->topicRepository->add($newTopic);
		$this->addFlashMessage('Created a new topic.');
		$this->redirect('suggest');
	}

	/**
	 * Shows a form for editing an existing topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to edit
	 *
	 * @return void
	 */
	public function editAction(Topic $topic) {
		$this->view->assign('topic', $topic);
		$this->view->assign('categories', $this->categoryRepository->findAll());
		$this->view->assign('types', $this->typeRepository->findAll());
	}

	/**
	 * Updates the given topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to update
	 *
	 * @return void
	 */
	public function updateAction(Topic $topic) {
		$this->topicRepository->update($topic);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Updated the topic.');
		$this->redirect('suggest');
	}

	/**
	 * Removes the given topic object from the topic repository
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to delete
	 *
	 * @return void
	 */
	public function deleteAction(Topic $topic) {
		$this->topicRepository->remove($topic);
		$this->addFlashMessage('Deleted a topic.');
		$this->persistenceManager->persistAll();
		$this->redirect('suggest');
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
	 * Accept a suggested topic
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to accept
	 *
	 * @return void
	 */
	public function acceptAction(Topic $topic) {
		$topic->setStatus($this->settings['statusOptions']['accepted']);
		$this->topicRepository->update($topic);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Topic accepted.');
		$this->redirect('listAccepted');
	}

	/**
	 * Un Accept a suggested topic
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to accept
	 *
	 * @return void
	 */
	public function rejectAction(Topic $topic) {
		$topic->setStatus($this->settings['statusOptions']['rejected']);
		$this->topicRepository->update($topic);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Topic was reject');
		$this->redirect('suggest');
	}

	/**
	 * List Accepted Topic the Training
	 *
	 * @return void
	 */
	public function listAcceptedAction() {
		$this->view->assign('acceptedTopics', $this->topicRepository->findByStatus($this->settings['statusOptions']['accepted']));
		$this->view->assign('currentPage', 'listAccepted');
	}

	/**
	 * Shows a form for set plan an existing topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to edit
	 *
	 * @return void
	 */
	public function planAction(Topic $topic) {
		$this->view->assign('topic', $topic);
		$this->view->assign('trainers', $this->userRepository->findAll());
		$this->view->assign('locations', $this->locationRepository->findAll());
		$this->view->assign('types', $this->typeRepository->findAll());
	}

	/**
	 * Initialize the schedule action
	 *
	 * @return void
	 */
	public function initializeScheduleAction() {
		$this->arguments['topic']->getPropertyMappingConfiguration()->forProperty('trainingDateFrom')
			->setTypeConverterOption('TYPO3\Flow\Property\TypeConverter\DateTimeConverter',
				\TYPO3\Flow\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, $this->settings['dateTimeFormat']);
		$this->arguments['topic']->getPropertyMappingConfiguration()->forProperty('trainingDateTo')
			->setTypeConverterOption('TYPO3\Flow\Property\TypeConverter\DateTimeConverter',
				\TYPO3\Flow\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, $this->settings['dateTimeFormat']);
	}

	/**
	 * Schedule the given topic object
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to scheudle
	 *
	 * @Flow\Validate(argumentName="topic.trainingDateFrom", type="NotEmpty")
	 * @Flow\Validate(argumentName="topic.trainingDateTo", type="NotEmpty")
	 * @Flow\Validate(argumentName="topic", type="Chantrea.Training:GreaterThan")
	 * @Flow\Validate(argumentName="topic", type="Chantrea.Training:RoomAvailable")
	 * @Flow\Validate(argumentName="topic", type="Chantrea.Training:TrainerAvailable")
	 * @Flow\Validate(argumentName="topic.location", type="NotEmpty")
	 * @return void
	 */
	public function scheduleAction(Topic $topic) {
		try {
			$trainers = $this->request->getArgument('trainers') == '' ? array() : $this->request->getArgument('trainers');
			foreach ($trainers as $trainer) {
				$newTrainer = $this->userRepository->findByIdentifier($trainer);
				$topic->addTrainer($newTrainer);
			}

			$topic->setStatus($this->settings['statusOptions']['scheduled']);
			$this->topicRepository->update($topic);
			$this->addFlashMessage('Scheduled the topic.');
			$this->redirect('listTraining');
		} catch (\PDOException $exception) {
			$this->addFlashMessage($exception->getMessage(), '', Message::SEVERITY_ERROR);
		}
	}

	/**
	 * List of Training Topics
	 *
	 * @return void
	 */
	public function listTrainingAction() {
		// find archieve topics
		$currentDate = date("Y-m-d H:i:s");
		$archieveTopics = $this->topicRepository->findArchieve($currentDate, $this->settings['statusOptions']['scheduled']);
		$this->view->assign('archieveTopics', $archieveTopics);

		$this->view->assign('availableTopics', $this->topicRepository->findByStatus($this->settings['statusOptions']['scheduled'], NULL, $currentDate));
		$this->view->assign('currentPage', 'listTraining');
	}

	/**
	 * Vote a topic
	 *
	 * @param \Chantrea\Training\Domain\Model\Topic $topic The topic to vote
	 *
	 * @return void
	 */
	public function voteAction(Topic $topic) {
		$topic->addVoteUser($this->securityContext->getAccount()->getParty());
		$this->topicRepository->update($topic);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Voting success.');
		$this->redirect('suggest');
	}

	/**
	 * View report
	 *
	 * @return void
	 */
	public function viewReportAction() {
		$this->view->assign('statuses', $this->settings['statusOptions']);
		$this->view->assign('users', $this->userRepository->findAll());
		$this->view->assign('categories', $this->categoryRepository->findAll());
		$this->view->assign('currentPage', 'viewReport');
		$this->view->assign('searchResults', $this->topicRepository->findAll());
	}

	/**
	 * Show result of search  report
	 *
	 * @return void
	 */
	public function showReportByFilterAction() {
		$user = $this->request->hasArgument('userFilter') ? $user = $this->request->getArgument('userFilter') : '';
		$status = $this->request->hasArgument('statusFilter') ? $this->request->getArgument('statusFilter') : '';
		$category = $this->request->hasArgument('categoryFilter') ? $this->request->getArgument('categoryFilter') : '';
		$this->view->assign('searchResults', $this->topicRepository->findTopicByFilter($user, $status, $category));
		$this->view->assign('currentPage', 'viewReport');
	}

	/**
	 * Show admin page
	 *
	 * @return void
	 */
	public function administratorAction() {
		$this->view->assign('categories', $this->categoryRepository->findAll());
		$this->view->assign('locations', $this->locationRepository->findAll());
		$this->view->assign('types', $this->typeRepository->findAll());
		$this->view->assign('levels', $this->levelRepository->findAll());
		$this->view->assign('currentPage', 'admin');
	}
}
?>
