<?php
namespace Frappant\FrpExample\Tests\Functional\Domain\Repository;

require_once __DIR__ . '/../../BasicFrontendEnvironmentTrait.php';

use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use Frappant\FrpExample\Domain\Repository\ItemRepository;
use Frappant\FrpExample\Domain\Model\Dto\ItemDemand;
use Frappant\FrpExample\Domain\Model\Item;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 R3 H6 <r3h6@outlook.com>
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
 * Functional test
 *
 * Call this test from your document root.
 * phpunit --process-isolation --bootstrap typo3/sysext/core/Build/FunctionalTestsBootstrap.php typo3conf/ext/frp_example/Tests/Functional/Domain/Repository/ItemRepositoryTest.php
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class ItemRepositoryTest extends \TYPO3\CMS\Core\Tests\FunctionalTestCase {

	use \Frappant\FrpExample\Tests\Functional\BasicFrontendEnvironmentTrait;

	protected $coreExtensionsToLoad = array('extbase');
	protected $testExtensionsToLoad = array('typo3conf/ext/frp_example');

	/**
	 * @var TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * @var \Frappant\FrpExample\Domain\Repository\ItemRepository
	 */
	protected $itemRepository = NULL;

	public function setUp (){
		parent::setUp();
		$this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$this->itemRepository = $this->objectManager->get(ItemRepository::class);

		$this->importDataSet(ORIGINAL_ROOT . 'typo3/sysext/core/Tests/Functional/Fixtures/pages.xml');
		$this->importDataSet(ORIGINAL_ROOT . 'typo3conf/ext/frp_example/Tests/Functional/Domain/Repository/Fixtures/sys_template.xml');
		$this->importDataSet(ORIGINAL_ROOT . 'typo3conf/ext/frp_example/Tests/Functional/Domain/Repository/Fixtures/item.xml');

		$this->setUpBasicFrontendEnvironment();
	}

	public function tearDown (){
		parent::tearDown();
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function findAll (){
		$items = $this->itemRepository->findAll();
		$this->assertCount(3, $items);
	}

	/**
	 * @test
	 * @dataProvider searchByTitleDataProvider
	 */
	public function searchByTitle ($title, $matches){
		$itemDemand = new ItemDemand();
		$itemDemand->setTitle($title);

		$items = $this->itemRepository->findDemanded($itemDemand);
		$this->assertCount($matches, $items);
		$this->assertContainsOnlyInstancesOf(Item::class, $items);
	}

	public function searchByTitleDataProvider (){
		return array(
			array('Ipsum', 1),
			array('ore', 2),
		);
	}
}