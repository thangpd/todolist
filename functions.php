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

function home_url() {
	return ROOT_URI;
}

function handle_sql_error( $query, $error_message ) {

	echo '<pre>';
	print_r( $query );
	echo '</pre>';
	echo $error_message;
}

function is_user_logged_in() {
	$user_model = \Todolist\models\UserModel::getInstance();

	return $user_model->verifyLoginUser();
}

function get_current_user_name() {
	if ( isset( $_SESSION['current_user'] ) ) {
		return $_SESSION['current_user']['user_name'];
	} else {
		return false;
	}
}

function todo_enqueue_scripts( $unique_key, $path, $dependency = '', $position = true ) {
	$enqueue = \Todolist\core\components\Enqueue::getInstance();
	$enqueue->add_enqueue_scripts( $unique_key, $path, $dependency, $position );
}

function todo_enqueue_styles( $unique_key, $path, $dependency = '' ) {
	\Todolist\core\components\Enqueue::getInstance()->add_enqueue_styles( $unique_key, $path, $dependency );
}

function todo_header() {
	$enqueue = \Todolist\core\components\Enqueue::getInstance();
	$enqueue->print_enqueue_scripts( true );
	$enqueue->print_enqueue_styles();
}

/** Print script in footer*/
function todo_footer() {
	\Todolist\core\components\Enqueue::getInstance()->print_enqueue_scripts( false );
}

/** Redirect page */
function todo_redirect( $location, $status = '302' ) {
	header( "Location: " . $location, false, $status );
}



