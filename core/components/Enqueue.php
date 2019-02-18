<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 2/15/19
 * Time: 8:40 AM
 */


namespace Todolist\core\components;


use \Todolist\core\BaseObject;


class Enqueue extends BaseObject {

	private static $scripts = [];
	private static $styles = [];

	public function add_enqueue_scripts( $unique_key, $path, $dependency = '', $position = true ) {
		self::$scripts[ $unique_key ] =
			array(
				'path'       => $path,
				'dependency' => $dependency,
				'position'   => $position
			);
	}

	public function add_enqueue_styles( $unique_key, $path, $dependency ) {
		self::$styles[ $unique_key ] =
			array(
				'path'       => $path,
				'dependency' => $dependency,
			);
	}

	public function print_enqueue_scripts( $position = true ) {
		if ( ! empty( self::$scripts ) ):
			ob_start();
			foreach ( self::$scripts as $key => $val ) {
				if ( $val['position'] && $position && ! empty( $val['path'] ) ) {
					echo '<script src="' . $val['path'] . '"></script>';
				}
				if ( ! $val['position'] && ! $position && ! empty( $val['path'] ) ) {
					echo '<script src="' . $val['path'] . '"></script>';
				}
			}
			$output = ob_get_clean();
			print_r( $output );
		endif;
	}

	public function print_enqueue_styles() {
		if ( ! empty( self::$styles ) ):
			ob_start();
			foreach ( self::$styles as $key => $val ):
				if ( $val['path'] ) {
					echo '<link rel="stylesheet" href="' . $val['path'] . '">';
				}
			endforeach;
			$output = ob_get_clean();
			print_r( $output );
		endif;
	}

}