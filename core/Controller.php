<?php

namespace Todolist\core;


abstract class Controller extends BaseObject {
	public $viewPath = '';

	/**
	 * Controller constructor.
	 *
	 * @param array $config
	 */
	public function __construct() {
		parent::__construct();
		$this->viewPath = dirname( ( $this->getPath() ) ) . DIRECTORY_SEPARATOR . 'views/' . $this->getControllerName();
	}

	/**
	 * Get controller name without Controller suffix
	 * @return bool|string
	 */
	protected function getControllerName() {
		$className      = self::className();
		$classNameParts = explode( "\\", $className );
		$className      = $classNameParts[ count( $classNameParts ) - 1 ];
		if ( preg_match( "/^(.*?)Controller$/", $className, $matches ) ) {
			return strtolower( $matches[1] );
		}

		return false;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		$reflector = new \ReflectionClass( get_called_class() );
		$fn        = $reflector->getFileName();
		$path      = dirname( $fn );

		return todo()->helper->fixPath( $path );
	}

	/**
	 * Render view and passed data to client
	 * if $return is true, return rendered result to caller
	 *
	 * @param string $view
	 * @param array $data
	 * @param bool $return
	 *
	 * @return string
	 * @throws RuntimeException
	 */
	public function render( $view = '', $data = [], $return = false ) {
		if ( empty( $view ) ) {
			$view = $this->getControllerName();
		}
		$viewPath = $this->viewPath . DIRECTORY_SEPARATOR . $view;
		if ( ! preg_match( '/\.php$/i', $viewPath ) ) {
			$viewPath .= '.php';
		}
		$data['context'] = $this;
		$data['helpers'] = todo()->helper;
		if ( file_exists( $viewPath ) ) {
			$content = todo()->helper->renderPhpFile( $viewPath, $data );
			if ( $return ) {
				return $content;
			}
			print $content;
		} else {
			throw new \RuntimeException( "The view {$viewPath} could not be found" );
		}
	}

	/**
	 * Render a php file with provided path
	 *
	 * @param $file
	 * @param array $data
	 * @param bool $return
	 *
	 * @return string
	 * @throws RuntimeException
	 */
	public function renderFile( $file, $data = [], $return = false ) {
		if ( file_exists( $file ) ) {
			$data['context'] = $this;
			$content         = todo()->helper->renderPhpFile( $file, $data );
			if ( $return ) {
				return $content;
			}
			print $content;
		} else {
			throw new \RuntimeException( "The view file {$file} could not be found" );
		}
	}

	/**
	 * Case not found
	 * @return string
	 */
	public function notFound() {
		$this->renderFile( ABSPATH.'views'.DIRECTORY_SEPARATOR.'not_found.php' );
	}

}