<?php
/**
 * Module Loader
 *
 * Load and manage multiple theme modules.
 *
 * @package Astoundify
 * @subpackage ModuleLoader
 * @since 1.0.0
 */
class Astoundify_ModuleLoader_Loader {

	/**
	 * Bootstrap
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		if ( ! empty( $this->modules ) ) {
			$this->load_modules();
		}
	}

	/**
	 * Get a specific module directly if available.
	 *
	 * @since 1.0.0
	 *
	 * @param string $module_name
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call( $name, $args ) {
		if ( $this->has_module_instance( $name ) ) {
			return $this->get_module( $name, $args );
		} 
		
		return call_user_func_array( $name, $args );
	}

	/**
	 * Load multiple modules.
	 *
	 * @since 1.0.0
	 *
	 * @param array $modules The modules to load
	 */
	public function load_modules( $modules = array() ) {
		$this->modules = wp_parse_args( $modules, $this->modules );

		foreach ( $this->modules as $module_name => $module_dependency ) {
			if ( $this->has_module_instance( $module_name ) ) {
				continue;
			}

			$module = $this->create_instance( $module_dependency );

			if ( $module ) {
				$this->add_module( $module_name, $module );
			}
		}
	}

	/**
	 * Get a module
	 *
	 * @since 1.0.0
	 *
	 * @param string $module_name
	 * @param string $module_dependency
	 * @return object Astoundify\Module
	 */
	public function get_module( $module_name, $args = false ) {
		$module = $this->modules[ $module_name ];

		if ( $args && ! empty( $args ) ) {
			$submodule = $args[0];
			return $module->$submodule();
		}
		
		return $this->modules[ $module_name ];
	}

	/**
	 * Add a module
	 *
	 * @since 1.0.0
	 *
	 * @param string $module_name
	 * @param string $module_dependency
	 * @return void
	 */
	public function add_module( $module_name, $module ) {
		// module instance exists
		if ( $this->has_module_instance( $module_name ) ) {
			return;
		}

		// add to the list
		$this->modules[ $module_name ] = $module;
	}

	/**
	 * Does this module exist?
	 *
	 * @since 1.0.0
	 *
	 * @param string $module_name
	 * @return bool
	 */
	public function has_module( $module_name ) {
		return isset( $this->modules[ $module_name ] );
	}

	/**
	 * Does this module exist and is it an object.
	 *
	 * @since 1.0.0
	 *
	 * @param string $module_name
	 * @return bool
	 */
	public function has_module_instance( $module_name ) {
		return $this->has_module( $module_name );
	}

	/**
	 * Create an instance of a module.
	 *
	 * @since 1.0.0
	 *
	 * @param string $module_class
	 * @return object
	 */
	public function create_instance( $module_class ) {
		$module_class = str_replace( '/', '_', $module_class );

		return new $module_class;
	}

}
