<?php
/**
 * Infinity Theme: screens classes file
 *
 * @author Marshall Sorenson <marshall.sorenson@gmail.com>
 * @link http://marshallsorenson.com/
 * @copyright Copyright (C) 2010 Marshall Sorenson
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package api
 * @subpackage screens
 * @since 1.0
 */

Pie_Easy_Loader::load( 'screens' );

/**
 * Infinity Theme: screens policy
 *
 * @package api
 * @subpackage screens
 */
class Infinity_Screens_Policy extends Pie_Easy_Screens_Policy
{
	/**
	 * @return Pie_Easy_Screens_Policy
	 */
	static public function instance()
	{
		self::$calling_class = __CLASS__;
		return parent::instance();
	}
	
	/**
	 * Return the name of the implementing API
	 *
	 * @return string
	 */
	final public function get_api_slug()
	{
		return 'infinity_theme';
	}

	/**
	 * @return Infinity_Screens_Registry
	 */
	final public function new_registry()
	{
		return new Infinity_Screens_Registry();
	}

	/**
	 * @return Infinity_Exts_Screen_Factory
	 */
	final public function new_factory()
	{
		return new Infinity_Exts_Screen_Factory();
	}

	/**
	 * @return Infinity_Screens_Renderer
	 */
	final public function new_renderer()
	{
		return new Infinity_Screens_Renderer();
	}

	/**
	 * @param string $ext
	 * @return Pie_Easy_Screens_Screen
	 */
	final public function load_ext( $ext )
	{
		return infinity_load_extension( $this->get_handle(), $ext );
	}

}

/**
 * Infinity Theme: screens registry
 *
 * @package api
 * @subpackage screens
 */
class Infinity_Screens_Registry extends Pie_Easy_Screens_Registry
{
	// nothing custom yet
}

/**
 * Infinity Theme: section factory
 *
 * @package api
 * @subpackage exts
 */
class Infinity_Exts_Screen_Factory extends Pie_Easy_Screens_Factory
{
	// nothing custom yet
}

/**
 * Infinity Theme: screens renderer
 *
 * @package api
 * @subpackage screens
 */
class Infinity_Screens_Renderer extends Pie_Easy_Screens_Renderer
{
	// nothing custom yet
}

?>
