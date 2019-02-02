<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 1/21/19
 * Time: 10:40 PM
 */

namespace Todolist\core;


class App extends BaseObject {

	private static $instance = null;
	/**
	 * App components
	 * @var array
	 */
	private $_components = [
		'router' => '\Todolist\core\components\Router',
		'helper' => '\Todolist\core\components\Helper',
		'db' => '\Todolist\core\components\Db',
	];

	/**
	 * App constructor.
	 */

	public function __construct() {
		parent::__construct();
		$this->setupComponents();
	}


	/**
	 * Setup Components
	 */
	public function setupComponents() {
		foreach ( $this->_components as $key => $handleClass ) {
			if ( empty( $this->$key ) ) {
				$this->$key = $handleClass::getInstance();
			}
		}
	}


	/**
	 * Get Instance of App Reference.
	 */
	public static function getInstance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new App();
		}
		$app = &self::$instance;

		return $app;
	}


}