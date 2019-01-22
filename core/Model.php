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


	/**
	 * @return mixed
	 * example :
	 * return [
	 *    'name' => [
	 *        'label' => 'Name',
	 *        'validate' => ['text', ['length' => 200, 'required' => true, 'message' => 'Please enter a valid name']]
	 *    ],
	 *    'age' => [
	 *        'label' => 'Age',
	 *        'validate' => ['number', ['max' => 100, 'min' => 0, 'message' => 'Please enter a valid age']]
	 *    ]
	 * ]
	 */
	public abstract function getAttributes();

	/**
	 * Abstract function get name of table/model
	 * @return mixed
	 */
	public abstract function getName();


}