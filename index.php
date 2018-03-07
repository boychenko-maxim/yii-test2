<?php

$config=dirname(__FILE__).'/protected/config/main.php';

defined('YII_DEBUG');

// include Yii bootstrap file
require_once(dirname(__FILE__).'/../../framework/yii.php');

//todo УБРАТЬ
function dd($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die();
}

// create a Web application instance and run
Yii::createWebApplication($config)->run();