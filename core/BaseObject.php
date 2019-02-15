<?php


namespace Todolist\core;


abstract class BaseObject extends \stdClass {


	private static $instances = null;

	/**
	 * Get instance of class.
	 *
	 * @access public
	 * @static
	 * @return object Return the instance class or create first instance of the class.
	 */

	public static function getInstance() {

		$class = static::className();
		if ( empty( static::$instances[ $class ] ) ) {
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
		$this->init();
	}


	/**
	 * Init function load attribute after instance object
	 */
	public function init() {

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












