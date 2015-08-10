<?php
namespace Frappant\FrpExample\Domain\Model\Dto;

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
use \TYPO3\CMS\Core\Utility\GeneralUtility;
/**
 * ItemDemand
 */
class ItemDemand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 * @validate Alphanumeric
	 */
	protected $title = '';

	/**
	 * [$limit description]
	 * @var integer
	 */
	protected $limit = 0;

	/**
	 * [factory description]
	 * @param  array  $demandProperties [description]
	 * @return Frappant\FrpExample\Domain\Model\Dto\ItemDemand
	 */
	public static function factory (array $demandProperties){
		$propertyMapper = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('TYPO3\\CMS\\Extbase\\Property\\PropertyMapper');
		$itemDemand = $propertyMapper->convert($demandProperties, 'Frappant\\FrpExample\\Domain\\Model\\Dto\\ItemDemand');
		return $itemDemand;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the limit
	 *
	 * @return int $limit
	 */
	public function getLimit(){
		return $this->limit;
	}

	/**
	 * Sets the limit
	 *
	 * @param int $limit
	 */
	public function setLimit($limit){
		$this->limit = $limit;
	}
}