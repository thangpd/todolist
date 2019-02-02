<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 1/21/19
 * Time: 10:15 PM
 */

namespace Todolist\core;


abstract class Model extends BaseObject {
	/**
	 * Object data
	 * Used for magics function
	 * @var array
	 */
	public $__data = [];
	/**
	 * Object attribute
	 * @var array
	 */
	public $attributes = [];

	public function init() {
		parent::init();
		$this->attributes = $this->getAttributes();
	}


	/**
	 * @return mixed
	 */
	public abstract function getAttributes();

	/**
	 * @params array $args
	 *
	 * @return mixed
	 */
	public abstract function getData( $args );

	/**
	 * Abstract function get name of table/model
	 * @return mixed
	 */
	public abstract function getName();


}