<?php
/**
 * Module API
 *
 * @package Astoundify
 * @subpackage ModuleLoader
 * @since 1.0.0
 */

if ( ! class_exists( 'Astoundify_ModuleLoader_Module' ) ) :
/**
 * Module API
 *
 * @since 1.0.0
 */
class Astoundify_ModuleLoader_Module extends Astoundify_ModuleLoader_Loader implements Astoundify_ModuleLoader_ModuleInterface, Astoundify_ModuleLoader_HookInterface, Astoundify_ModuleLoader_LoadInterface {

	/**
	 * @since 1.0.0
	 * @var bool $is_loaded
	 * @access protected
	 */
	protected $is_loaded = false;

	/**
	 * @since 1.0.0
	 * @var bool $is_hooked
	 * @access protected
	 */
	protected $is_hooked = false;

	/**
	 * @since 1.0.0
	 * @var array $modules
	 * @access protected
	 */
	protected $modules = array();

	/**
	 * Bootstrap
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->load();
		$this->hook();

		parent::__construct();
	}

	/**
	 * Load dependencies
	 *
	 * @since 1.0.0
	 */
	public function load() {
		if ( $this->is_loaded() ) {
			return;
		}

		$this->is_loaded = true;
	}

	/**
	 * Have the dependencies been loaded?
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_loaded() {
		return (bool) $this->is_loaded;
	}

	/**
	 * Hook in to WordPress
	 *
	 * @since 1.0.0
	 */
	public function hook() {
		if ( $this->is_hooked() ) {
			return;
		}

		$this->is_hooked = true;
	}

	/**
	 * Is hooked in to WordPress?
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_hooked() {
		return (bool) $this->is_hooked;
	}

}
endif;
