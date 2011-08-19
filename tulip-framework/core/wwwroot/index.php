<?php
/*
 * Automatic framework loader & MVC handler
 */

require_once(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'System' . DIRECTORY_SEPARATOR . 'AutoLoader.php');

System\Tulip::init(__FILE__);
Controller\Controller::loadController();