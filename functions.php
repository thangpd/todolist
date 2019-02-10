<?php


function todo() {
	return \Todolist\core\App::getInstance();
}

function get_header() {
	require ABSPATH . 'views/inc/header.php';
}

function get_footer() {
	require ABSPATH . 'views/inc/footer.php';
}

function handle_sql_error( $query, $error_message ) {

	echo '<pre>';
	print_r( $query );
	echo '</pre>';
	echo $error_message;
}

function is_user_logged_in() {
	$user_model = new \Todolist\models\UserModel();

	return $user_model->verifyLoginUser();
}

function get_current_user_name() {
	if ( is_user_logged_in() ) {
		return $_SESSION['current_user']['user'];
	} else {
		return false;
	}
}


