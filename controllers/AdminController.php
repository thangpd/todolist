<?php

namespace Todolist\controllers;

use Todolist\core\Controller;

class AdminController extends Controller {





	/** render page admin
	 * @return mixed
	 */
	public function render( $view = '', $data = [], $return = false ) {
		if ( ! is_user_logged_in() ) {
			todo_redirect( LoginController::getInstance()->getRelativePagePath('login') );
		}

		return parent::render( $view, $data, $return ); // TODO: Change the autogenerated stub
	}


}