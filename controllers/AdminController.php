<?php

namespace Todolist\controllers;

use Todolist\core\Controller;
use Todolist\models\UserModel;

class AdminController extends Controller {


	/**
	 * Create user
	 */
	public function signUp() {

		if ( ! empty( $_POST ) ) {
			$model = new UserModel();
			$model->registerUser( $_POST );


		}
		$this->render( 'signup' );
	}

	/**
	 * Login
	 * return @string;
	 */
	public function login() {

		$model = new UserModel();
		if ( $model->verifyLoginUser( $_POST ) ) {
			$this->render( 'admin' );
		} else {
			$this->render( 'login' );
		}
	}

}