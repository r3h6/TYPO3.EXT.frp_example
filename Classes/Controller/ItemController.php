<?php
namespace Frappant\FrpExample\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 !frappant Webfactory <support@frappant.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use \Frappant\FrpExample\Domain\Model\Dto\ItemDemand;
/**
 * ItemController
 */
class ItemController extends ActionController {

	const ARGUMENT_DEMAND = 'itemDemand';

	/**
	 * [$setup description]
	 * @var Frappant\FrpExample\Configuration\Setup
	 * @inject
	 */
	protected $setup;

	/**
	 * itemRepository
	 *
	 * @var \Frappant\FrpExample\Domain\Repository\ItemRepository
	 * @inject
	 */
	protected $itemRepository = NULL;

	/**
	 * [initializeAction description]
	 * @return void
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->data = $this->configurationManager->getContentObject()->data;
		$this->isAjax = (isset($this->setup['ajaxPageType']) && $this->setup['ajaxPageType'] === GeneralUtility::_GP('type'));
	}

	/**
	 * [initializeView description]
	 * @param  \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view [description]
	 * @return void
	 */
	public function initializeView (\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view){
		$view->assign('layout', $this->isAjax ? 'Ajax': 'Default');
		$view->assign('setup', $this->setup);
		$view->assign('data', $this->data);
	}

	public function initializeListAction (){
		if (!$this->request->hasArgument(self::ARGUMENT_DEMAND)){
			/** @var \Frappant\FrpExample\Domain\Model\Dto\ItemDemand */
			$itemDemand = ItemDemand::factory($this->setup->get('list.demand', array()));
			$this->request->setArgument(self::ARGUMENT_DEMAND, $itemDemand); // Doesn't get validated!
		}
	}

	/**
	 * action list
	 *
	 * @param \Frappant\FrpExample\Domain\Model\Dto\ItemDemand $itemDemand
	 * @return void
	 */
	public function listAction(\Frappant\FrpExample\Domain\Model\Dto\ItemDemand $itemDemand) {
		$items = $this->itemRepository->findDemanded($itemDemand);
		$this->view->assign('items', $items);
	}

	/**
	 * action show
	 *
	 * @param \Frappant\FrpExample\Domain\Model\Item $item
	 * @return void
	 */
	public function showAction(\Frappant\FrpExample\Domain\Model\Item $item) {
		$this->view->assign('item', $item);
	}

	/**
	 * action new
	 *
	 * @param \Frappant\FrpExample\Domain\Model\Item $newItem
	 * @ignorevalidation $newItem
	 * @return void
	 */
	public function newAction(\Frappant\FrpExample\Domain\Model\Item $newItem = NULL) {
		$this->view->assign('newItem', $newItem);
	}

	/**
	 * action create
	 *
	 * @param \Frappant\FrpExample\Domain\Model\Item $newItem
	 * @return void
	 */
	public function createAction(\Frappant\FrpExample\Domain\Model\Item $newItem) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->itemRepository->add($newItem);
		$this->redirect('list');
	}

}