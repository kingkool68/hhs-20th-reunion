<?php
/**
 * Helpers for rendering SVGs inline
 */
class RH_SVG {

	/**
	 * Get an instance of this class
	 */
	public static function get_instance() {
		static $instance = null;
		if ( null === $instance ) {
			$instance = new static();
		}
		return $instance;
	}

	/**
	 * Helper function for fetching SVG icons
	 *
	 * @param  string $icon  Name of the SVG file in the icons directory
	 * @param array  $args Arguments to modify the defaults passed to static::get_svg()
	 *
	 * @return string        Inline SVG markup
	 */
	public static function get_icon( $icon = '', $args = array() ) {
		if ( ! $icon ) {
			return;
		}
		$path     = 'assets/icons/' . $icon . '.svg';
		$defaults = array(
			'css_class' => 'icon icon-' . $icon,
		);
		$args     = array_merge( $defaults, $args );
		return static::get_svg( $path, $args );
    }


	/**
	 * Generic helper to modify the markup for a given path to an SVG
	 *
	 * @param  string $path  Absolute path to the SVG file
	 * @param  array  $args  Args to modify attributes of the SVG
	 * @return string        Inline SVG markup
	 */
	public static function get_svg( $path = '', $args = array() ) {
		if ( ! $path ) {
			return;
		}
		$defaults = array(
			'role'          => 'img',
			'css_class'     => '',
		);
		$args     = array_merge( $defaults, $args );
		if ( file_exists( $path ) ) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$svg = file_get_contents( $path );
			// Strip the width and height attributes so size can be scaled via CSS font-size
			// $svg = preg_replace( '/\s(width|height)="[\d\.]+"/i', '', $svg );
			$svg = str_replace( '<svg ', '<svg class="' . $args['css_class'] . '" role="' . $args['role'] . '" ', $svg );
			return $svg;
		}
	}
}

RH_SVG::get_instance();
