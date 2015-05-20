<?php

if (version_compare(phpversion(), '5.1.0', '<') == true) { die ('PHP5.1 Only'); }

require_once SYS_PATH . 'Core/Log.php';

spl_autoload_register(function($class) {

    $className = $class;
    if (strrpos($class, '\\') > -1) {
        $className = substr($class, strrpos($class, '\\')+1);
    }
    $folders = array(
        APP_PATH . 'Controllers',
        SYS_PATH . 'Core',
        SYS_PATH . 'Helpers',
    );
    foreach ($folders as $folder) {
        $filename = $folder . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($filename)) {
            DemoSimpleFramework\Log::instance()->add_debug('Autoload: ' . $filename . ' +');
            require_once $filename;
            return;
        } else {
            DemoSimpleFramework\Log::instance()->add_debug('Autoload: ' . $filename . ' -');
        }
    }
});
