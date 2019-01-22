<?php


namespace Todolist\core;


abstract class BaseObject extends \stdClass {

	private static $instances = null;

	public static function getInstance() {

		$class = self::className();
		if ( empty( self::$instances[ $class ] ) ) {
			self::$instances[ $class ] = new $class();
		}
		$app = self::$instances[ $class ];

		return $app;

	}

	/**
	 * Returns the fully qualified name of this class.
	 * @return string the fully qualified name of this class.
	 */
	public static function className() {
		return get_called_class();
	}

	/**
	 * Constructor BaseObject.
	 */
	public function __construct() {

	}

	/**
	 * Get instance of app
	 * @return App
	 */
	public function getApp() {
		if ( empty( $this->app ) ) {
			$this->app = App::getInstance();
		}

		return $this->app;
	}


}












