<?php
namespace Chantrea\Training\ViewHelpers;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Fluid".                 *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * View helper which renders the flash messages (if there are any) as an unsorted list.
 *
 * @api
 */
class FlashMessagesViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Renders flash messages that have been added to the FlashMessageContainer in previous request(s).
	 *
	 * @param string $as The name of the current flashMessage variable for rendering inside
	 * @param string $severity severity of the messages (One of the \TYPO3\Flow\Error\Message::SEVERITY_* constants)
	 * @return string rendered Flash Messages, if there are any.
	 * @api
	 */
	public function render($as = NULL, $severity = NULL) {
		$flashMessages = $this->controllerContext->getFlashMessageContainer()->getMessagesAndFlush($severity);
		if (count($flashMessages) < 1) {
			return '';
		}
		if ($as === NULL) {
			$content = $this->renderAsList($flashMessages);
		} else {
			$content = $this->renderFromTemplate($flashMessages, $as);
		}
		return $content;
	}

	/**
	 * Render the flash messages as unsorted list. This is triggered if no "as" argument is given
	 * to the ViewHelper.
	 *
	 * @param array $flashMessages
	 * @return string
	 */
	protected function renderAsList(array $flashMessages) {
		$content = '';
		foreach ($flashMessages as $singleFlashMessage) {
			$alertClass = 'info';
			switch (strtolower($singleFlashMessage->getSeverity())) {
				case 'ok':
					$alertClass = 'success';
					break;
				case 'error':
					$alertClass = 'danger';
					break;
				default:
					$alertClass = strtolower($singleFlashMessage->getSeverity());
			}
			$severityClass = 'alert alert-block alert-' . $alertClass . ' fade in';
			$messageContent = htmlspecialchars($singleFlashMessage->render());
			if ($singleFlashMessage->getTitle() !== '') {
				$messageContent = sprintf('<strong>%s</strong> ', htmlspecialchars($singleFlashMessage->getTitle())) . $messageContent;
			}
			$content .= '<div class="' . htmlspecialchars($severityClass) . '"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' . $messageContent . '</div>';
		}

		return $content;
	}

	/**
	 * Defer the rendering of Flash Messages to the template. In this case,
	 * the flash messages are stored in the template inside the variable specified
	 * in "as".
	 *
	 * @param array $flashMessages
	 * @param string $as
	 * @return string
	 */
	protected function renderFromTemplate(array $flashMessages, $as) {
		$templateVariableContainer = $this->renderingContext->getTemplateVariableContainer();
		$templateVariableContainer->add($as, $flashMessages);
		$content = $this->renderChildren();
		$templateVariableContainer->remove($as);

		return $content;
	}
}
?>