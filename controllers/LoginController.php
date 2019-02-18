<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 2/18/19
 * Time: 4:46 PM
 */

namespace Todolist\controllers;

use Todolist\core\Controller;
use Todolist\models\UserModel;

class LoginController extends Controller {


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
			todo_redirect( AdminController::getInstance()->getRelativePagePath() );
		} else {
			$this->render( 'login' );
		}
	}

	/**
	 * Logout
	 * @return null;
	 */
	public function logout() {
		setcookie( 'login_token', '', time() - 1 );
		unset( $_COOKIE['login_token'] );
		todo_redirect( $this->getRelativePagePath(
			'login'
		) );
	}


}