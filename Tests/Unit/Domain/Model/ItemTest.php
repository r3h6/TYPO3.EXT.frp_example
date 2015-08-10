<?php

namespace Frappant\FrpExample\Tests\Unit\Domain\Model;

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
 * Test case for class \Frappant\FrpExample\Domain\Model\Item.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author !frappant Webfactory <support@frappant.ch>
 */
class ItemTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Frappant\FrpExample\Domain\Model\Item
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Frappant\FrpExample\Domain\Model\Item();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProductionDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getProductionDate()
		);
	}

	/**
	 * @test
	 */
	public function setProductionDateForDateTimeSetsProductionDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setProductionDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'productionDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGroupsReturnsInitialValueForGroup() {
		$this->assertEquals(
			NULL,
			$this->subject->getGroups()
		);
	}

	/**
	 * @test
	 */
	public function setGroupsForGroupSetsGroups() {
		$groupsFixture = new \Frappant\FrpExample\Domain\Model\Group();
		$this->subject->setGroups($groupsFixture);

		$this->assertAttributeEquals(
			$groupsFixture,
			'groups',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUserReturnsInitialValueForUser() {
		$this->assertEquals(
			NULL,
			$this->subject->getUser()
		);
	}

	/**
	 * @test
	 */
	public function setUserForUserSetsUser() {
		$userFixture = new \Frappant\FrpExample\Domain\Model\User();
		$this->subject->setUser($userFixture);

		$this->assertAttributeEquals(
			$userFixture,
			'user',
			$this->subject
		);
	}
}
