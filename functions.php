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

function handle_sql_error($query,$error_message){

	echo '<pre>';
	print_r($query);
	echo '</pre>';
	echo $error_message;
}