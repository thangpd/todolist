<?php
/** Database name*/
define( 'DB_NAME', 'todolist' );
/** */
define( 'DB_USER', 'root' );


define( 'DB_PASSWORD', '' );


define( 'DB_HOST', 'localhost' );

define( 'DB_CHARACTER', 'utf8' );

define( 'DB_COLLATE', '' );

define( 'ROOT_URL', ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] );

define( 'TODOLIST_NAMESPACE', 'Todolist' );

