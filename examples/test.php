<?php
/**
 *
 */
class Your_Plugin_Test extends Astoundify_ModuleLoader_Module {

	/**
	 * @since 1.0.0
	 * @var array $modules
	 * @access protected
	 */
	protected $modules = array(
		'foo' => 'foo/manager',
	);

	/**
	 * Bootstrap
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		parent::__construct();
	}

}
