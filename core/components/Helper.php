<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 1/21/19
 * Time: 10:49 PM
 */

namespace Todolist\core\components;


use Todolist\core\BaseObject;

class Helper extends BaseObject {

	/**
	 * Render PHP file included attached params
	 *
	 * @param $_file_
	 * @param array $_params_
	 *
	 * @return string
	 * @throws \Exception
	 * @throws \Throwable
	 */
	public function renderPhpFile( $_file_, $_params_ = [] ) {
		$_obInitialLevel_ = ob_get_level();
		ob_start();
		ob_implicit_flush( false );
		extract( $_params_, EXTR_OVERWRITE );
		try {
			require( $_file_ );
			$result = ob_get_clean();

			return $result;
		} catch ( \Exception $e ) {
			while ( ob_get_level() > $_obInitialLevel_ ) {
				if ( ! @ob_end_clean() ) {
					ob_clean();
				}
			}
			throw $e;
		} catch ( \Throwable $e ) {
			while ( ob_get_level() > $_obInitialLevel_ ) {
				if ( ! @ob_end_clean() ) {
					ob_clean();
				}
			}
			throw $e;
		}
	}

	/**
	 * Fix directory path on windows
	 *
	 * @param $path
	 *
	 * @return mixed
	 */
	public function fixPath( $path ) {
		$pathSep = DIRECTORY_SEPARATOR;

		return str_replace( '/', $pathSep, $path );
	}
}