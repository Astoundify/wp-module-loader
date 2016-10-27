<?php
/**
 * Basic example.
 *
 * @since 1.0.0
 */

/**
 * Filter the directory classes are looked for in.
 *
 * @since 1.0.0
 *
 * @param string $dir
 * @return string
 */
function astoundify_moduleloader_autoload_directory( $dir ) {
	return dirname( __FILE__ );
}
add_filter( 'astoundify_moduleloader_autoload_directory', 'astoundify_moduleloader_autoload_directory' );

/**
 * Load the library
 */
require_once( dirname( dirname( __FILE__ ) ) . '/astoundify-moduleloader/astoundify-moduleloader.php' );

// autoload a class and load its modules
new Astoundify_Test();
