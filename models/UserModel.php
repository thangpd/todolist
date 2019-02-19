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
			'ID'            => false,
			'user_name'     => '',
			'user_password' => '',
			'email'         => '',
			'cookie'        => '',
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
		if ( $this->issetUser( $data['user_name'] ) ) {
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

		if ( ! isset( $_COOKIE['login_token'] ) || empty( $_COOKIE['login_token'] ) ) {
			if ( ! empty( $data['user_name'] ) && ! empty( $data['user_password'] ) ) {
				//select users from db
				$sql    = 'select ' . implode( ',', array_keys( $data ) ) . ' from users where user_name="' . $data['user_name'] . '" and user_password="' . md5( $data['user_password'] ) . '" ';
				$result = $this->getApp()->helper->getQueryResult( $sql );
				$result = array_shift( $result );
				if ( ! empty( $result['ID'] ) ) {
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
				}
			}

			return false;

		} elseif ( isset( $_COOKIE['login_token'] ) && ! empty( $_COOKIE['login_token'] ) ) {
			$sql = 'select * from users where cookie="' . $_COOKIE['login_token'] . '"';
			$sql = $this->getApp()->helper->getQueryResult( $sql );
			if ( ! empty( $sql ) ) {
				$result = array_shift( $sql );
				$this->set_current_users( $result );
			} else {
				setcookie( 'login_token', "", time() - 1 );
				unset( $_COOKIE['login_token'] );
				$this->verifyLoginUser( $login_arr );
			}
		}
		if ( get_current_user_name() ) {
			return true;
		} else {
			return false;
		}

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
		$data['user_password'] = md5( $data['user_password'] );
		$sql                   = 'insert into ' . $this->getName() . ' (user_name,user_password,email) values("' . $data['user_name'] . '","' . $data['user_password'] . '","' . $data['email'] . '")';
		try {
			$sql = $this->getApp()->db->prepare( $sql );

			$sql->execute();

			return true;
		} catch ( \PDOException $e ) {
			echo 'error';
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
		$res = $this->getApp()->helper->getQueryResult( 'select * from users where user_name="' . $username . '"' );

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