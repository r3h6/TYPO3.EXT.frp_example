<?php
namespace Frappant\FrpExample\Domain\Model;

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
 * Item
 */
class Item extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * Production date
	 *
	 * @var \DateTime
	 */
	protected $productionDate = NULL;

	/**
	 * Groups
	 *
	 * @var \Frappant\FrpExample\Domain\Model\Group
	 */
	protected $groups = NULL;

	/**
	 * user
	 *
	 * @var \Frappant\FrpExample\Domain\Model\User
	 */
	protected $user = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		
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
	 * Returns the productionDate
	 *
	 * @return \DateTime $productionDate
	 */
	public function getProductionDate() {
		return $this->productionDate;
	}

	/**
	 * Sets the productionDate
	 *
	 * @param \DateTime $productionDate
	 * @return void
	 */
	public function setProductionDate(\DateTime $productionDate) {
		$this->productionDate = $productionDate;
	}

	/**
	 * Returns the groups
	 *
	 * @return \Frappant\FrpExample\Domain\Model\Group $groups
	 */
	public function getGroups() {
		return $this->groups;
	}

	/**
	 * Sets the groups
	 *
	 * @param \Frappant\FrpExample\Domain\Model\Group $groups
	 * @return void
	 */
	public function setGroups(\Frappant\FrpExample\Domain\Model\Group $groups) {
		$this->groups = $groups;
	}

	/**
	 * Returns the user
	 *
	 * @return \Frappant\FrpExample\Domain\Model\User $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the user
	 *
	 * @param \Frappant\FrpExample\Domain\Model\User $user
	 * @return void
	 */
	public function setUser(\Frappant\FrpExample\Domain\Model\User $user) {
		$this->user = $user;
	}

}