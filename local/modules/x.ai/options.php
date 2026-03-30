<?
/**
 * @var CUser $USER
 * @var CMain $APPLICATION
 * @var string $REQUEST_METHOD
 * @var string $save
 * @var string $apply
 */

if(!$USER->IsAdmin()) return;

if (!\Bitrix\Main\Loader::includeModule('x.module')) {
	return;
}

$DirName = basename(__DIR__);
$dctModuleProps = \X\Module\Modules::getModuleProps($DirName);

include(\X\Module\Util\Options::getOptionsPageFile());