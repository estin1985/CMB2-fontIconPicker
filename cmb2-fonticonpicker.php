<?php
/**
 * Plugin Name: CMB2 fontIconPicker
 * Plugin URI:  http://www.private-partners.com
 * Description: A fontIconPicker based on the jQuery plugin (https://codeb.it/fonticonpicker/)
 * Version:     1.0.0
 * Author:      Jared Melchert
 * Author URI:  http://www.private-partners.com
 * Donate link: http://www.private-partners.com
 * License:     MIT
 * Text Domain: cmb2-fonticonpicker
 * Domain Path: /languages
 *
 * @link    https://webdevstudios.com
 *
 * @package CMB2_FontIconPicker
 * @version 0.0.0
 *
 * Built using generator-plugin-wp (https://github.com/WebDevStudios/generator-plugin-wp)
 */

/**
 * Copyright (c) 2017 Jared Melchert (email : jared@private-partners.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


// Include additional php files here.
// require 'includes/something.php';

/**
 * Main initiation class.
 *
 * @since  0.0.0
 */
final class CMB2_FontIconPicker {

	/**
	 * Current version.
	 *
	 * @var    string
	 * @since  0.0.0
	 */
	const VERSION = '0.0.0';

	/**
	 * URL of plugin directory.
	 *
	 * @var    string
	 * @since  0.0.0
	 */
	protected $url = '';

	/**
	 * Path of plugin directory.
	 *
	 * @var    string
	 * @since  0.0.0
	 */
	protected $path = '';

	/**
	 * Plugin basename.
	 *
	 * @var    string
	 * @since  0.0.0
	 */
	protected $basename = '';

	/**
	 * Detailed activation error messages.
	 *
	 * @var    array
	 * @since  0.0.0
	 */
	protected $activation_errors = array();

	/**
	 * Singleton instance of plugin.
	 *
	 * @var    CMB2_FontIconPicker
	 * @since  0.0.0
	 */
	protected static $single_instance = null;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since   0.0.0
	 * @return  CMB2_FontIconPicker A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin.
	 *
	 * @since  0.0.0
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 *
	 * @since  0.0.0
	 */
	public function plugin_classes() {
		// $this->plugin_class = new CMB2FIP_Plugin_Class( $this );

	} // END OF PLUGIN CLASSES FUNCTION

	/**
	 * Add hooks and filters.
	 * Priority needs to be
	 * < 10 for CPT_Core,
	 * < 5 for Taxonomy_Core,
	 * and 0 for Widgets because widgets_init runs at init priority 1.
	 *
	 * @since  0.0.0
	 */
	public function hooks() {
		add_action( 'admin_enqueue_scripts', 	array( $this, 'styles' ) );
		add_action( 'admin_enqueue_scripts', 	array( $this, 'scripts' ) );
		add_action( 'cmb2_render_iconpicker', 	array( $this, 'render' ), 10, 5 );
		add_action( 'wp_enqueue_scripts',       array( $this, 'styles_frontend') );

	}

    /**
     * Render field
     */
    public function render( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    	echo $field_type_object->input( array( 'type' => 'text', 'class' => 'iconpicker' ) );
    }

	public function styles() {

		// Fontello Fonts CSS File
		wp_enqueue_style( 'cmb2-fip-css', $this->url . 'assets/css/fontello.css', array(), self::VERSION );
		// FontIconPicker Default CSS
		wp_enqueue_style( 'cmb2-fip-default-theme',  $this->url . 'assets/bower/fontIconPicker/css/jquery.fonticonpicker.min.css', array(), self::VERSION );
		// FontIconPicker Themes
        wp_enqueue_style( 'cmb2-fip-grey-theme',  $this->url . 'assets/bower/fontIconPicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css', array(), self::VERSION );
        wp_enqueue_style( 'cmb2-fip-dark-grey-theme',  $this->url . 'assets/bower/fontIconPicker/themes/dark-grey-theme/jquery.fonticonpicker.darkgrey.min.css', array(), self::VERSION );
        wp_enqueue_style( 'cmb2-fip-inverted-theme',  $this->url . 'assets/bower/fontIconPicker/themes/inverted-theme/jquery.fonticonpicker.inverted.min.css', array(), self::VERSION );
        wp_enqueue_style( 'cmb2-fip-bootstrap-theme',  $this->url . 'assets/bower/fontIconPicker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css', array(), self::VERSION );
	}

    public function scripts() {

    	// Register FontIconPicker Required JS
    	wp_register_script( 'cmb2-fip-js', $this->url . 'assets/bower/fontIconPicker/jquery.fonticonpicker.min.js' );
    	// Localize Data for FontIconPicker
    	wp_localize_script( 'cmb2-fip-js', 'cmb2_iconpicker_data', file_get_contents($this->path . 'config.json') );
    	// Load FontIconPicker JS
    	wp_enqueue_script( 'cmb2-fip-js' );
    	// Enqueue Plugin JS To Invoke FontIconPicker
    	wp_enqueue_script( 'cmb2-fip-js-loader', $this->url . 'assets/js/admin.js', array( 'jquery' ), self::VERSION );

    }

	/**
	 * Magic getter for our object.
	 *
	 * @since  0.0.0
	 *
	 * @param  string $field Field to get.
	 * @throws Exception     Throws an exception if the field is invalid.
	 * @return mixed         Value of the field.
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
				return $this->$field;
			default:
				throw new Exception( 'Invalid ' . __CLASS__ . ' property: ' . $field );
		}
	}
}

/**
 * Grab the CMB2_FontIconPicker object and return it.
 * Wrapper for CMB2_FontIconPicker::get_instance().
 *
 * @since  0.0.0
 * @return CMB2_FontIconPicker  Singleton instance of plugin class.
 */
function cmb2_fip() {
	return CMB2_FontIconPicker::get_instance();
}

// Kick it off.
add_action( 'plugins_loaded', array( cmb2_fip(), 'hooks' ) );

