<?php
/**
 * Required PHP 5.4+
 */
error_reporting(-1);
ini_set('display_errors', 1);

define('BASE_PATH', pathinfo(__FILE__, PATHINFO_BASENAME) . DIRECTORY_SEPARATOR);
define('APP_PATH', realpath('Application') . DIRECTORY_SEPARATOR);
define('SYS_PATH', realpath('System') . DIRECTORY_SEPARATOR);

require realpath('System') . DIRECTORY_SEPARATOR . 'Core/Autoload.php';

DemoSimpleFramework\Application::run();
