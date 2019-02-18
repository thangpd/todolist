<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 2/15/19
 * Time: 3:08 PM
 */

namespace Todolist\core\components;

use Todolist\core\BaseObject;

class Hook extends BaseObject {

	/**
	 * Init
	 * Register all things from the beginner
	 */
	public function init() {
		parent::init(); // TODO: Change the autogenerated stub

		$this->registerAssets();

	}

	/**
	 * predefine js,css
	 */
	public function registerAssets() {
		//scripts
		//libs
		todo_enqueue_scripts( 'video-js', ROOT_URI . 'assets/js/libs/video.js', '', true );
		//main script
		todo_enqueue_scripts( 'main-js', ROOT_URI . 'assets/js/main.js', '', true );
		//styles
		todo_enqueue_styles( 'todo-style', ROOT_URI . '/assets/css/style.css' );

	}

}