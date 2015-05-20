<?php

/**
 * Safe input.
 * Can be used with user input data such as $_POST, $_GET, $_COOKIE and so on
 *
 * Example of usage
 * $post = Input::getInstanceFor($_POST);
 * $post->getInt('id');
 */

class Input
{
    private $variable = null;
    private $maxLenght = -1;
    private $trimValues = false;

    private static $instance = null;

    private function __construct() {}
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public static function getInstanceFor($_variable)
    {
        $instance = self::getInstance();
        $instance->setVariable($_variable);
        return $instance;
    }

    public function setVariable($_variable)
    {
        $this->variable = $_variable;
    }

    public function getInt($_key, $_defaultValue = null) {
        $value = $this->getRawValue($_key, $_defaultValue);
        if (preg_match("/^-?\\d+$/", $value)) {
            return (int)$value;
        }
        return $_defaultValue;
    }

    public function getString($_key, $_defaultValue = null) {
        $value = $this->getRawValue($_key, $_defaultValue);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        if ($this->$maxLenght > 0) {
            $value = substr($value, 0, $this->maxLenght);
        }
        return $value;
    }

    public function getRawValue($_key, $_defaultValue = null) {
        $value = Arr::get($this->variable, $_key, $_defaultValue);
        if ($this->trimValues == true) {
            $value = trim($value);
        }
        return $value;
    }
}