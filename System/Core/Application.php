<?php
namespace DemoSimpleFramework;

    class Application
    {
        public static function init()
        {
        }
        public static function run()
        {
            $request = Request::instance();
            $controllerName = $request->getController();
            $actionName = $request->getAction();
            $parameters = $request->getParameters();
            $paramsController = '';
            $paramsAction = '';

            if (class_exists($controllerName) == false) {
                Log::instance()->add_error('Application: Controller `' . $controllerName . '` not found');
                $paramsController = strlen($controllerName) > 0 ? $controllerName . '/' : '';
                $controllerName = 'ControllerDefault';
            }
            $controller = new $controllerName();
            if (method_exists($controller, $actionName) == false) {
                Log::instance()->add_error('Application: Method ' . $controllerName . '::' . $actionName . '() not found');
                $paramsAction = strlen($actionName) > 0 ? $actionName . '/' : '';
                $actionName = 'index';
            }
            $parameters = $paramsController . $paramsAction . $parameters;

            $controller->__before();
            Log::instance()->add_debug('Application: Call ' . $controllerName . '::' . $actionName . '(`' . $parameters . '`)');
            $controller->$actionName($parameters);
            $controller->__after();

            // Log execiution time
            $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
            Log::instance()->add_info('--- Execution time: ' . $time . ' sec');
        }
    }
