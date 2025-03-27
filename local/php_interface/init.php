<?php
// подгрузка всего из папки init
$lstInitsFile = scandir(__DIR__.'/init');
if ($lstInitsFile) $lstInitsFile = array_filter($lstInitsFile,function ($N) {return (
        substr($N,-4) == '.php'
    );});
if ($lstInitsFile) foreach ($lstInitsFile as $FileName) include(__DIR__.'/init/'.$FileName);