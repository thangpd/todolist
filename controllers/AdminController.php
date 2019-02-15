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
			if ( $model->registerUser( $_POST ) ) {
				$this->render( 'login' );
			}

		} else {
			$this->render( 'signup' );
		}
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

	/**
	 * Logout
	 * @return null;
	 */
	public function logout() {
		if ( isset( $_POST['user_name'] ) && isset( $_POST['password'] ) ) {
			$this->login();
		} else {
			setcookie( 'login_token', '', time() - 1 );
			unset( $_COOKIE['login_token'] );
			$this->render( 'login' );
		}
	}

}