<?php
/**
 * ICE API: base factory class file
 *
 * @author Marshall Sorenson <marshall@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Marshall Sorenson
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package ICE
 * @subpackage base
 * @since 1.0
 */

ICE_Loader::load( 'base/componentable' );

/**
 * Make creating concrete components easy
 *
 * @package ICE
 * @subpackage base
 */
abstract class ICE_Factory extends ICE_Componentable
{
	/**
	 * Component type to use when none configured
	 */
	const DEFAULT_COMPONENT_TYPE = 'default';

	/**
	 * Load a component extension
	 *
	 * Override this class to load component class files which exist outside of ICE's path
	 *
	 * @param string $ext Name of the extension
	 * @return string Name of the class which was loaded
	 */
	public function load_ext( $ext )
	{
		// expand extension name
		$ext_full = sprintf( '%s/%s', $this->policy()->get_handle( false ), $ext );

		// format extension file name
		$ext_file = sprintf( '%s/%s/class.php', $this->policy()->get_handle(), $ext );

		// look for scheme files first
		$file_theme = ICE_Scheme::instance()->locate_extension_file( $ext_file );

		// find a theme file?
		if ( $file_theme ) {

			// format class name
			$class_name = ICE_Files::file_to_class( $ext_full, ICE_EXT_PREFIX );

			// load the file
			require_once $file_theme;

			// class must exist
			if ( class_exists( $class_name ) ) {
				return $class_name;
			} else {
				throw new Exception( sprintf( 'The class "%s" does not exist in the file %s', $class_name, $file_theme ) );
			}

		} else {
			// format dist ext type
			$ext_dist = sprintf( '%s/%s', $this->policy()->get_handle(), $ext );
			// try for a distro extension
			return ICE_Loader::load_libext( $ext_dist );
		}
	}

	/**
	 * Return an instance of a component
	 *
	 * @param string $name
	 * @param array $config
	 * @return ICE_Component
	 */
	public function create( $name, $config )
	{
		// puke on empty theme
		if ( empty( $config['theme'] ) ) {
			throw new Exception( 'Theme cannot be empty' );
		}

		// set default type if necessary
		if ( empty( $config['type'] ) ) {
			$config['type'] = self::DEFAULT_COMPONENT_TYPE;
		}

		// make sure the extension is loaded
		$class_name = $this->load_ext( $config['type'] );

		// create new component
		$component = new $class_name( $name, $config['type'], $config['theme'], $this->policy() );

		// all done
		return $component;
	}

}

?>
