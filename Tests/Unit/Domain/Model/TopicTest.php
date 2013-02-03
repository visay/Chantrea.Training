<?php
namespace Chantrea\Training\Tests\Unit\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Chantrea.Training".     *
 *                                                                        *
 *                                                                        */

use Chantrea\Training\Domain\Model\Topic;

/**
 * Testcase for Topic
 */
class TopicTest extends \TYPO3\Flow\Tests\UnitTestCase {

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
}
?>