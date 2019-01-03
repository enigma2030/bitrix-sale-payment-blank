<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$data = [
	'NAME' => Loc::getMessage('NAME'),
	'SORT' => 100,
	'CODES' => [
		'PROPERTY_1' => [
			'NAME' => Loc::getMessage('PROPERTY_1'),
			'SORT' => 100,
			'GROUP' => 'GENERAL_SETTINGS'
		]
	]
];