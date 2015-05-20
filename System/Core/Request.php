<?php
namespace DemoSimpleFramework;

class Request
{
    protected $uri = null;
    protected $controller = '';
    protected $action = '';
    protected $parameters = '';

    private static $instance;
    private function __construct() {
        Log::instance()->add_debug('Request: $_GET: `' . implode('`, `', $_GET) . '`');
        $this->uri = \Arr::get($_GET, 'route');
        $parts = explode('/', $this->uri, 3);

        if (strlen(\Arr::get($parts, 0)) > 0) {
            if (strpos(\Arr::get($parts, 0), '?') === false) {
                $this->controller = ucfirst(\Arr::get($parts, 0));
            }
        }

        $this->action = \Arr::get($parts, 1);
        $this->parameters = \Arr::get($parts, 2);
        Log::instance()->add_debug('Request: Controller: `' . $this->getController() . '`');
        Log::instance()->add_debug('Request: Action: `' . $this->getAction() . '`');
        Log::instance()->add_debug('Request: Parameters: `' . $this->getParameters() . '`');
    }
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function get_uri() {
        return $this->uri;
    }
    function getFullController() { return 'Application\Controllers\\' . $this->controller; }
    function getController() { return $this->controller; }
    function getAction() { return $this->action; }
    function getParameters() { return $this->parameters; }
}