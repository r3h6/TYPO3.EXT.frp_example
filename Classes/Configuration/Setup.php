<?php
namespace Frappant\FrpExample\Configuration;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 !frappant webfactory <support@frappant.ch>
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
 * Setup
 */
class Setup implements \ArrayAccess {
	/**
	 * ConfigurationManager
	 * @var TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * Delimeter
	 * Used to seperate the path.
	 * @var string
	 */
	protected $delimiter = '.';

	/**
	 * The settings array.
	 * @var array
	 */
	protected $array;

	/**
	 * Constructor
	 * @param array $array [description]
	 */
	public function __construct (array $array = array()){
		$this->array = $array;
	}

	/**
	 * [initializeObject description]
	 * @return void
	 */
	public function initializeObject (){
		if (empty($this->array)){
			$settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS);
			$this->mergeSettings($settings);
		}
	}

	/**
	 * Merges setup and flexform settings.
	 * @param  array  $settings [description]
	 * @return void
	 */
	public function mergeSettings (array $settings) {
		if (isset($settings['setup']) && is_array($settings['setup'])){
			$this->array = \TYPO3\CMS\Extbase\Utility\ArrayUtility::arrayMergeRecursiveOverrule($this->array, $settings['setup'], FALSE, FALSE);
		}
		if (isset($settings['flexform']) && is_array($settings['flexform'])){
			$this->array = \TYPO3\CMS\Extbase\Utility\ArrayUtility::arrayMergeRecursiveOverrule($this->array, $settings['flexform'], FALSE, FALSE);
		}
	}

	/**
	 * Get value by path.
	 * @param  string $path    Path to value.
	 * @param  mixed $default  Return value if none could by found.
	 * @return mixed
	 */
	public function get ($path, $default = NULL){
		try {
			$value = \TYPO3\CMS\Core\Utility\ArrayUtility::getValueByPath($this->array, $path, $this->delimiter);
		} catch (\RuntimeException $exception){
			$value = $default;
		}
		return $value;
	}

	/**
	 * Set value by path.
	 * @param string $path  Path to value.
	 * @param mixed $value
	 */
	public function set ($path, $value){
		// try {
			$this->array = \TYPO3\CMS\Core\Utility\ArrayUtility::setValueByPath($this->array, $path, $value, $this->delimiter);
		// } catch (\RuntimeException $exception){
		// }
	}

	/**
	 * [__toString description]
	 * @return string Serialized object.
	 */
	public function __toString (){
		return serialize($this->array);
	}

	// {{{ ArrayAccess
	final public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->array[] = $value;
		} else {
			$this->array[$offset] = $value;
		}
	}
	final public function offsetExists($offset) {
		return isset($this->array[$offset]);
	}
	final public function offsetUnset($offset) {
		unset($this->array[$offset]);
	}
	final public function offsetGet($offset) {
		return isset($this->array[$offset]) ? $this->array[$offset] : NULL;
	}
	// }}}
}