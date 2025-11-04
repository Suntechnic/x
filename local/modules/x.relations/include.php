<?
\Bitrix\Main\Loader::includeModule('x.module');

$tmpMODULE_PATH_ABS = __DIR__;
$tmpMODULE_DIR = basename($tmpMODULE_PATH_ABS);
$tmpMODULE_SPACE = explode('.',$tmpMODULE_DIR)[0];
$tmpMODULE_UID = explode('.',$tmpMODULE_DIR)[1];
$Class = '\\'.ucfirst($tmpMODULE_SPACE).'\\'.ucfirst($tmpMODULE_UID).'\Module';
unset($tmpMODULE_PATH_ABS,$tmpMODULE_DIR,$tmpMODULE_SPACE,$tmpMODULE_UID);

$module = new $Class(); unset($Class);

$module->regEntities();
$module->loadComposerLibs();