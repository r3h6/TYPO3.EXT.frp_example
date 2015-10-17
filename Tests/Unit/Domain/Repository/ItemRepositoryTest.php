<?php

namespace Frappant\FrpExample\Tests\Unit\Domain\Repository;

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
use Frappant\FrpExample\Domain\Repository\ItemRepository;
use Frappant\FrpExample\Domain\Model\Dto\ItemDemand;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;

/**
 * Test case for class \Frappant\FrpExample\Domain\Repository\ItemRepository.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author !frappant Webfactory <support@frappant.ch>
 */
class ItemRepositoryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Frappant\FrpExample\Domain\Repository\ItemRepository
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock(ItemRepository::class, array('createQuery'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}


	/**
	 * @test
	 */
	public function findDemanded (){
		$itemDemand = $this->getMock(ItemDemand::class);
		$result = $this->getMock(QueryResult::class, array(), array(), '', FALSE);
		$query = $this->getMock(Query::class, array('execute'), array(), '', FALSE);

		$itemDemand
			->expects($this->once())
			->method('getTitle')
			->will($this->returnValue(''));

		$itemDemand
			->expects($this->once())
			->method('getLimit')
			->will($this->returnValue(0));

		$query
			->expects($this->once())
			->method('execute')
			->will($this->returnValue($result));

		$this->subject
			->expects($this->once())
			->method('createQuery')
			->will($this->returnValue($query));

		$this->assertEquals(
			$result,
			$this->subject->findDemanded($itemDemand)
		);
	}


}
