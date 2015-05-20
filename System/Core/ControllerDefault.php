<?php
/**
 * Default controller. For the case if application hasn't its own controller
 */
class ControllerDefault extends DemoSimpleFramework\ControllerBase
{
    function index()
    {
        self::error404();
    }
}