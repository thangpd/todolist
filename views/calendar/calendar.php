<?php


echo 'cal';


$arr = array(
	'id'     => false,
	'user'   => 'asldkfj',
	'pass'   => 'asdfkjh',
	'email'  => 'ljasdf@gmail.cm',
	'cookie' => '',
);;


echo '<pre>';
print_r( implode( ',', array_keys( $arr ) ) );
echo '</pre>';

echo '<pre>';
print_r( "\"" . implode( '","', array_values( $arr ) ) . "\"" );
echo '</pre>';


