<?php

namespace Todolist\core\components;

use Todolist\core\BaseObject;

class Router extends BaseObject {

	public static function run() {
		$params = array(
			'ctrl'   => ! empty( $_GET['p'] ) ? $_GET['p'] : 'calendar',
			'action' => ! empty( $_GET['a'] ) ? $_GET['a'] : 'render'
		);

		$nspace_controller = TODOLIST_NAMESPACE . '\\controllers\\';

		$ctrl = ucfirst( $params['ctrl'] ) . 'Controller';

		if ( is_file( ABSPATH . 'controllers' . DIRECTORY_SEPARATOR . $ctrl . '.php' ) ) {
			$ctrl    = $nspace_controller . $ctrl;
			$objCtrl = new $ctrl;
			if ( ( new \ReflectionClass( $objCtrl ) )->hasMethod( $params['action'] ) && ( new \ReflectionMethod( $objCtrl, $params['action'] ) )->isPublic() ) {
				call_user_func( array( $objCtrl, $params['action'] ) );
			} else {
				call_user_func( array( $objCtrl, 'notFound' ) );
			}

		}
	}
}