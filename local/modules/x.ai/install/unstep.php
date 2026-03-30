<?php
if (!check_bitrix_sessid()) return;
if (!class_exists('X\Ai\Module')) include __DIR__.'/../lib/module.php';
$module = new \X\Ai\Module;
\CAdminMessage::ShowNote($module->getMessage('UNINSTALL_MESSAGE'));