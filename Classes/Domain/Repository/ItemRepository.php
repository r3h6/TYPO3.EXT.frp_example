<?php
namespace Frappant\FrpExample\Domain\Repository;

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

/**
 * The repository for Items
 */
class ItemRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array(
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
	);

	/**
	 * [findDemanded description]
	 *
	 * @param \Frappant\FrpExample\Domain\Model\Dto\ItemDemand $itemDemand [description]
	 * @return [type]                                                       [description]
	 */
	public function findDemanded(\Frappant\FrpExample\Domain\Model\Dto\ItemDemand $itemDemand) {

		/** @var TYPO3\CMS\Extbase\Persistence\Generic\Query $query */
		$query = $this->createQuery();

		// $querySettings = $query->getQuerySettings();
		$constraints = array();
		if ($itemDemand->getTitle()) {
			$constraints[] = $this->createTitleConstraint($query, $itemDemand->getTitle());
		}
		// if ($itemDemand->getGroup()){
		// 	$constraints[] = $query->contains('groups', $itemDemand->getGroup());
		// }
		if (!empty($constraints)) {
			$query->matching(
				$query->logicalAnd($constraints)
			);
		}

		if ($itemDemand->getLimit()) {
			$query->setLimit($itemDemand->getLimit());
		}
		return $query->execute();
	}

	/**
	 * @param $query
	 * @param $title
	 */
	protected function createTitleConstraint($query, $title) {
		$constraints = array();
		$constraints[] = $query->like('title', '%' . $title . '%');
		//$constraints[] = $query->like('groups.title', '%' . $title . '%');
		return $query->logicalOr($constraints);
	}

}