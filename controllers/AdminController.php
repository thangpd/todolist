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
		echo '<pre>';
		print_r( $_POST );
		echo '</pre>';
		if ( ! empty( $_POST ) ) {
			echo ' has post';
			$model = new UserModel();
			$model->verifyLoginUser( $_POST );
		}

		$this->render( 'login' );
	}

}