<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 1/21/19
 * Time: 10:12 PM
 */

namespace Todolist\models;

use http\Exception;
use Todolist\core\Model;

class UserModel extends Model {

	/**
	 * @return mixed
	 */
	public function getAttributes() {
		return array(
			'id'    => false,
			'user'  => '',
			'pass'  => '',
			'email' => '',
		);
	}

	/**
	 * @return mixed
	 */
	public function getData( $args = [] ) {
		if ( ! empty( $args ) && is_array( $args ) ) {
			return array_merge( $this->getAttributes(), $args );
		} else {
			return [];
		}
	}

	/**
	 * Abstract function get name of table/model
	 * @return mixed
	 */
	public function getName() {
		return 'users';
	}

	/**
	 * Verify isset User
	 *
	 * @param array
	 *
	 * @return bool;
	 */
	public function verifyUser( $data ) {
		if ( $this->issetUser( $data['user'] ) ) {
			echo 'User is already registered';

			return false;
		}
		if ( $this->issetEmail( $data['email'] ) ) {
			echo 'Email is already registered';

			return false;
		}

		return true;

	}

	/**
	 * Verify login user
	 *
	 * @param array
	 *
	 * @return bool
	 */

	public function verifyLoginUser( $login_arr = array() ) {
		$login_arr = ! empty( $login_arr ) ? $login_arr : $_POST;
		$data      = $this->getData( $login_arr );
		if ( ! isset( $_COOKIE['login_token'] ) ) {

			if ( ! empty( $data['user'] ) && ! empty( $data['pass'] ) ) {
				//select users from db
				$sql    = 'select ID, user, password,email from users where user="' . $data['user'] . '" and password="' . md5( $data['pass'] ) . '" ';
				$result = $this->getApp()->helper->getQueryResult( $sql );
				$result = array_shift( $result );
				// set session current_user
				$this->set_current_users( $result );
				//create token for cookie remember login
				$token = md5( implode( ',', $result ) . rand() );
				//set cookie
				setcookie( 'login_token', $token );
				//update cookie for user to valid cookie later
				$sql = 'update users set cookie = "' . $token . '" where ID=' . $result['ID'];
				$sql = $this->getApp()->db->prepare( $sql );
				$sql->execute();

				return true;
			} else {
				return false;
			}
		} else {
			if ( isset( $_COOKIE['login_token'] ) && ! empty( $_COOKIE['login_token'] ) ) {
				$sql = 'select ID,user,password,email from users where cookie="' . $_COOKIE['login_token'] . '"';
				$sql = $this->getApp()->helper->getQueryResult( $sql );
				if ( ! empty( $sql ) ) {
					$result = array_shift( $sql );
					$this->set_current_users( $result );
				} else {
					setcookie( 'login_token', "", time() - 1 );
					$this->verifyLoginUser( $login_arr );
				}
			}
		}

		return true;
	}

	/**
	 * Set current user
	 *
	 * @params array users attributes
	 *
	 * @return void
	 *
	 */
	private function set_current_users( $arrs_user ) {
		if ( session_status() !== PHP_SESSION_ACTIVE ) {
			session_start();
		}
		$_SESSION['current_user'] = $arrs_user;
	}

	/**
	 * Register user
	 *
	 * @params from attributes
	 *
	 * @return bool;
	 * */
	public function registerUser( $args ) {
		$data = $this->getData( $args );

		if ( ! $this->verifyUser( $data ) ) {
			return false;
		}


		$sql = 'insert into ' . $this->getName() . ' values(';
		foreach ( $data as $key => $val ) {
			if ( $key == 'pass' ) {
				$val = md5( $val );
			}
			switch ( $val ) {
				//case $val false is not append to query string
				case false:
					$sql .= '""';
					break;
				default:
					$sql .= ',"' . $val . '"';
					break;
			}

		}
		$sql .= ');';
		try {
			$sql = $this->getApp()->db->prepare( $sql );
			$sql->execute();
			echo 'sign up ok';
		} catch ( \PDOException $e ) {
			handle_sql_error( $sql, $e->getMessage() );
		}

	}


	/**
	 * get user by name
	 *
	 * @param string
	 *
	 * @return @array
	 */
	public function getUserByName( $username ) {
		$res = $this->getApp()->helper->getQueryResult( 'select * from users where user="' . $username . '"' );

		return $res;
	}

	/**
	 * get user by email
	 *
	 * @param string
	 *
	 * @return @array
	 */
	public function getUserByEmail( $email ) {
		$res = $this->getApp()->helper->getQueryResult( 'select * from users where email="' . $email . '"' );

		return $res;

	}


	/**
	 * check if isset username
	 * @return bool
	 */
	public function issetUser( $username ) {
		$arr_user = $this->getUserByName( $username );

		if ( ! empty( $arr_user ) && is_array( $arr_user ) ) {
			return true;
		} else {
			return false;
		}


	}

	/**
	 * check if isset email
	 * @return bool
	 */
	public function issetEmail( $email ) {
		$arr_user = $this->getUserByEmail( $email );
		if ( ! empty( $arr_user ) && is_array( $arr_user ) ) {
			return true;
		} else {
			return false;
		}


	}


	/**
	 * Update user
	 * @return bool;
	 */
	public function updateUser() {

	}

	/**
	 * Delete user
	 */
	public function deleteUser() {

	}


}