<?php
namespace DemoSimpleFramework;

    class Log
    {
        const TYPE_DEBUG = 'debug';
        const TYPE_ERROR = 'error';
        const TYPE_INFO  = 'info';

        protected $filename;
        protected static $instance = null;
        protected $_EOL = "<br/>\n";

        protected function __construct()
        {
            // Set up an log-file name
            $this->filename = APP_PATH . DIRECTORY_SEPARATOR . 'Logs' . DIRECTORY_SEPARATOR . 'common-' . date('Y-m') . '.html';
            // Write an emply line
            $this->write($this->_EOL);
            chmod($this->filename, 0666);
        }
        
        public static function instance()
        {
            if (is_null(self::$instance)) {
                self::$instance = new Log();
            }
            return self::$instance;
        }

        function add_debug($message) { $this->add($message, self::TYPE_DEBUG); }
        function add_error($message) { $this->add($message, self::TYPE_ERROR); }
        function add_info($message) { $this->add($message, self::TYPE_INFO); }
        function add($message, $type=self::TYPE_INFO)
        {
            $message = strtoupper($type) . ': ' . $message;
            $this->add_line($message);
        }

        protected function add_line($message)
        {
            // Add time and carriage return to message 
            $t = microtime(true);
            $micro = sprintf("%06d",($t - floor($t)) * 1000000);
            $d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
            $data = $d->format('Y-m-d H:i:s.u') . ' ' . $message . $this->_EOL;
            // Write message to log
            $this->write($data);
        }
        protected function write($data)
        {
            $file = fopen($this->filename, 'a');
            fwrite($file, $data);
            fclose ($file);
        }
    }
