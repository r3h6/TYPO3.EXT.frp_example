<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Frappant.' . $_EXTKEY,
	'Pi1',
	array(
		'Item' => 'list, show, new, create',
		
	),
	// non-cacheable actions
	array(
		'Item' => 'list, new, create',
		
	)
);
