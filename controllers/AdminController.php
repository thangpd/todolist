<?php

namespace Todolist\controllers;

use Todolist\core\Controller;

class AdminController extends Controller {

	/**
	 * Login controller
	 * return @string;
	 */
	public function login() {

		$this->render( 'login' );
	}

}