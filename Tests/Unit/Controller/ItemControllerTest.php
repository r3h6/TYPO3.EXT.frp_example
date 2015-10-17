<?php
namespace Frappant\FrpExample\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 !frappant Webfactory <support@frappant.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

/**
 * Test case for class Frappant\FrpExample\Controller\ItemController.
 *
 * @author !frappant Webfactory <support@frappant.ch>
 */
class ItemControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Frappant\FrpExample\Controller\ItemController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Frappant\\FrpExample\\Controller\\ItemController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesDemandedRecordsAndAssignThemToView() {
		$itemDemand = $this->getMock('Frappant\\FrpExample\\Domain\\Model\\Dto\\ItemDemand', array(), array(), '', FALSE);
		$items = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		// Mock repository
		$itemRepository = $this->getMock('Frappant\\FrpExample\\Domain\\Repository\\ItemRepository', array('findDemanded'), array(), '', FALSE);
		$itemRepository->expects($this->once())->method('findDemanded')->will($this->returnValue($items));
		$this->inject($this->subject, 'itemRepository', $itemRepository);

		// Mock view
		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view
			->expects($this->exactly(2))
			->method('assign')
			->withConsecutive(
				array('items', $items),
				array('itemDemand', $itemDemand)
			);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction($itemDemand);
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenItemToView() {
		$item = new \Frappant\FrpExample\Domain\Model\Item();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('item', $item);

		$this->subject->showAction($item);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenItemToView() {
		$item = new \Frappant\FrpExample\Domain\Model\Item();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newItem', $item);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($item);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenItemToItemRepository() {
		$item = new \Frappant\FrpExample\Domain\Model\Item();

		$itemRepository = $this->getMock('Frappant\\FrpExample\\Domain\\Repository\\ItemRepository', array('add'), array(), '', FALSE);
		$itemRepository->expects($this->once())->method('add')->with($item);
		$this->inject($this->subject, 'itemRepository', $itemRepository);

		$this->subject
			->expects($this->once())
			->method('addFlashMessage');

		$this->subject->createAction($item);
	}
}
