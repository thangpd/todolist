<?php

namespace Todolist;


use Todolist\core\components\Hook;
use Todolist\core\components\Router;

define( 'ABSPATH', __DIR__ . DIRECTORY_SEPARATOR );

require ABSPATH . 'config.php';
require ABSPATH . 'functions.php';
require ABSPATH . 'Autoload.php';

try {
	Autoload::getInstance()->init();
	Hook::getInstance();
	Router::run();
	Router::end();

} catch ( \Exception $e ) {
	echo $e->getMessage();
}


























































