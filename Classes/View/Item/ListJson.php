<?php
namespace Frappant\FrpExample\View\Item;

class ListJson extends \TYPO3\CMS\Extbase\Mvc\View\JsonView {

	/**
	 * http://www.pluswerk.ag/blog/2014/04/02/typo3-cms-6-2-lts-was-ist-neu-in-extbase-fluid/
	 * @return [type] [description]
	 */
	public function initializeView (){
		$this->setVariablesToRender(array('items'));
	}

}