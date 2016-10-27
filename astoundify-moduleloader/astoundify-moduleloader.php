<?php
/**
 * Autoloader for Modules
 *
 * Based on an example implementation of PSR-4, but compatible with PHP 5.2.
 *
 * Calling `new Astoundify_Theme_Assets()` will automatically load `/inc/theme/assets.php`
 *
 * @see Filter: `astoundify_moduleloader_autoload_prefix`
 * @see Filter: `astoundify_moduleloader_autoload_directory`
 * @link http://www.php-fig.org/psr/psr-4/examples/
 *
 * @since 1.0.0
 *
 * @param string $class
 */

function astoundify_moduleloader_autoload( $class ) {
	// Prefix for all classes that are loaded
	$prefix = apply_filters( 'astoundify_moduleloader_autoload_prefix', 'Astoundify_' );
	$length = strlen( $prefix );

	// Loader prefix
	$l_prefix = 'Astoundify_ModuleLoader_';
	$l_length = strlen( $l_prefix );

	// Does the current class have the set prefix?
	if ( 0 !== strncmp( $prefix, $class, $length ) && 0 !== strncmp( $l_prefix, $class, $l_length ) ) {
		// No, move to the next registered autoloader.
		return;
	}
	
	// loader
	if ( 0 === strncmp( $l_prefix, $class, $l_length ) ) {
		$base_dir = dirname( __FILE__ );
		$relative_class = strtolower( substr( $class, $l_length ) );
		$file = trailingslashit( $base_dir ) . $relative_class . '.php';
	} else {
		$base_dir = apply_filters( 'astoundify_moduleloader_autoload_directory', get_template_directory() . '/inc/' );
		$relative_class = strtolower( substr( $class, $length ) );
		$file = trailingslashit( $base_dir ) . str_replace( '_', '/', $relative_class ) . '.php';
	}

	// Load the file if it exists and is readable
	if ( is_readable( $file ) ) {
		require_once $file;
	}
}

spl_autoload_register( 'astoundify_moduleloader_autoload' );
