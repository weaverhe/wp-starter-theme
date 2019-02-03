<?php
/**
 * Build a social menu which shows icons instead of text links
 *
 * @package starter-theme/inc/menus
 * @since 2.0.0
 */

/**
 * The class for the social menu.
 */
class Social_Menu {
	/**
	 * The constructor function to set everything up & do all the hooks/actions.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_footer', array( $this, 'include_icons' ) );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'social_menu_walker' ), 10, 4 );
	}

	/**
	 * Include the SVG icon file
	 *
	 * @return void
	 */
	public function include_icons() {
		// define the sprite file.
		$social_icons = get_template_directory() . '/assets/img/social-icons.svg';
		if ( file_exists( $social_icons ) ) {
			require_once $social_icons;
		}
	}

	/**
	 * A walker to display social icons
	 *
	 * @param string  $item_output The original menu item output.
	 * @param WP_Post $item        Menu item object.
	 * @param int     $depth       Depth of the menu.
	 * @param array   $args        wp_nav_menu() arguments.
	 * @return string
	 */
	public function social_menu_walker( $item_output, $item, $depth, $args ) {
		$social_icons = $this->supported_social_icons();
		$menu_name    = strtolower( $args->menu->name );

		if ( 'social' === $menu_name ) {
			foreach ( $social_icons as $attr => $value ) {
				if ( false !== strpos( $item_output, $attr ) ) {
					if ( $args->link_after ) {
						$item_output = str_replace( $args->link_after, '</span>' . $this->get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
					}
				}
			}
		}

		return $item_output;
	}

	/**
	 * Return the array of supported icons
	 *
	 * @return array
	 */
	public function supported_social_icons() {
		$social_links_icons = array(
			'behance.net'     => 'behance',
			'codepen.io'      => 'codepen',
			'deviantart.com'  => 'deviantart',
			'digg.com'        => 'digg',
			'docker.com'      => 'dockerhub',
			'dribbble.com'    => 'dribbble',
			'dropbox.com'     => 'dropbox',
			'facebook.com'    => 'facebook',
			'flickr.com'      => 'flickr',
			'foursquare.com'  => 'foursquare',
			'plus.google.com' => 'google-plus',
			'github.com'      => 'github',
			'instagram.com'   => 'instagram',
			'linkedin.com'    => 'linkedin',
			'mailto:'         => 'envelope-o',
			'medium.com'      => 'medium',
			'pinterest.com'   => 'pinterest-p',
			'pscp.tv'         => 'periscope',
			'getpocket.com'   => 'get-pocket',
			'reddit.com'      => 'reddit-alien',
			'skype.com'       => 'skype',
			'skype:'          => 'skype',
			'slideshare.net'  => 'slideshare',
			'snapchat.com'    => 'snapchat-ghost',
			'soundcloud.com'  => 'soundcloud',
			'spotify.com'     => 'spotify',
			'stumbleupon.com' => 'stumbleupon',
			'tumblr.com'      => 'tumblr',
			'twitch.tv'       => 'twitch',
			'twitter.com'     => 'twitter',
			'vimeo.com'       => 'vimeo',
			'vine.co'         => 'vine',
			'vk.com'          => 'vk',
			'wordpress.org'   => 'wordpress',
			'wordpress.com'   => 'wordpress',
			'yelp.com'        => 'yelp',
			'youtube.com'     => 'youtube',
		);

		return $social_links_icons;
	}

	/**
	 * Return the SVG markup
	 *
	 * @param array $args {
	 *  Parameters needed to display an SVG.
	 *  @type string $icon  Required SVG icon filename.
	 *  @type string $title Optional SVG title.
	 *  @type string $desc  Optional SVG description.
	 *
	 * }
	 * @return string SVG markup.
	 */
	public function get_svg( $args = array() ) {
		if ( empty( $args ) ) {
			return 'Please definie default parameters in the form of an array.';
		}

		if ( false === array_key_exists( 'icon', $args ) ) {
			return 'Please define an SVG icon filename.';
		}

		// set defaults.
		$defaults = array(
			'icon'     => '',
			'title'    => '',
			'desc'     => '',
			'fallback' => false,
		);

		// parse args.
		$args = wp_parse_args( $args, $defaults );

		// ARIA setup.
		$aria_hidden     = ' aria-hidden="true"';
		$aria_labelledby = '';

		if ( $args['title'] ) {
			$aria_hidden     = '';
			$unique_id       = uniqid();
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

			if ( $args['desc'] ) {
				$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
			}
		}

		// SVG markup.
		$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

		// Display the title.
		if ( $args['title'] ) {
			$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

			if ( $args['desc'] ) {
				$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
			}
		}

		// Display the icon.
		$svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';

		if ( $args['fallback'] ) {
			$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
		}

		$svg .= '</svg>';

		return $svg;
	}
}

/**
 * Init the menu
 */
new Social_Menu();
