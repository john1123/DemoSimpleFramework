<?php
namespace DemoSimpleFramework;

    /**
     * Base controller class
     */
    abstract class ControllerBase
    {
        public function __before(){}
        public function __after(){}
        public abstract function index();

        public function error404($_message='') {
            header("HTTP/1.0 404 Not Found");
            $output = strlen($_message) > 0 ? $_message : 'Page Not Found';
            echo $output;
            Log::instance()->add_error($output);
        }
    }
