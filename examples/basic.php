<?php
/**
 * Basic example.
 *
 * @since 1.0.0
 */

/**
 * Load the library
 */
require_once( dirname( dirname( __FILE__ ) ) . '/astoundify-moduleloader/astoundify-moduleloader.php' );

/**
 * Autoloader for Modules
 *
 * Autload all classes starting with `Your_Plugin_` and start
 * looking from the current directory down.
 *
 * @since 1.0.0
 *
 * @param string $class
 */
function astoundify_moduleloader( $class ) {
	$prefix = 'Your_Plugin_';
	$base_dir = dirname( __FILE__ );
	
	astoundify_moduleloader_autoload( $class, $prefix, $base_dir );
}
spl_autoload_register( 'astoundify_moduleloader' );

// autoload a class and access its modules
$test = new Your_Plugin_Test();
$foo = $test->foo();
$foo->hello();
