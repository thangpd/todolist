<?php

namespace Todolist;


class Autoload {


	private static $instance = null;

	public static function getInstance() {
		return ( static::$instance == null ) ? static::$instance = new static : static::$instance;
	}

	public function init() {

		spl_autoload_register( array( __CLASS__, 'loadClasses' ) );
	}

	public function loadClasses( $class ) {


		$class = str_replace( array( __NAMESPACE__, '\\' ), DIRECTORY_SEPARATOR, $class );
		if ( is_file( $file_name = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php' ) ) {
			require_once $file_name;
		}


	}


}