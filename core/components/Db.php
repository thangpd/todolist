<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 1/22/19
 * Time: 3:30 PM
 */

namespace Todolist\core\components;


use Todolist\core\BaseObject;

class Db extends BaseObject {


	private static $instance = null;


	public static function getInstance() {
		if ( ! self::$instance ) {
			$options[ \PDO::MYSQL_ATTR_INIT_COMMAND ] = 'SET NAMES UTF8';
			self::$instance                           = new \PDO( 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD, $options );
			self::$instance->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
		}

		return self::$instance;
	}


}