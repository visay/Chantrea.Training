<?php
namespace Chantrea\Training\Tests\Unit\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Tests\UnitTestCase;
use Chantrea\Training\Domain\Model\Topic;
use TYPO3\Flow\Security\Account;

/**
 * Testcase for Topic
 */
class TopicTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function setTitle() {
		$topic = new Topic();
		$topic->setTitle('Chantrea Training');
		$this->assertSame('Chantrea Training', $topic->getTitle());
	}

	/**
	 * @test
	 */
	public function setShortDescription() {
		$topic = new Topic();
		$topic->setShortDescription('Training description ...');
		$this->assertSame('Training description ...', $topic->getShortDescription());
	}

	/**
	 * @test
	 */
	public function setAccount() {
		$account = new Account();
		$account->setAccountIdentifier('visay');
		$topic = new Topic();
		$topic->setAccount($account);
		$this->assertSame('visay', $topic->getAccount()->getAccountIdentifier());
	}
}
?>