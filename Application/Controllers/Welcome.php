<?php

class Welcome extends DemoSimpleFramework\ControllerBase
{
    function index($params = '')
    {
        echo 'index(): ' . $params;
    }
}