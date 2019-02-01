<?php
/**
 * The class for standard theme functions
 *
 * @package starter-theme/classes
 */

/**
 * The Basic Theme class, with theme setup & other functionality.
 */
class Theme_Basics {
	/**
	 * The name of the theme
	 *
	 * @var string
	 */
	private $theme_name;

	/**
	 * The theme version number
	 *
	 * @var string
	 */
	private $theme_version;

	/**
	 * Access the after_setup_theme action via a shortcut function
	 *
	 * @param function $function the function called by the hook.
	 * @return void
	 */
	private function action_after_setup( $function ) {
		add_action(
			'after_setup_theme',
			function() use ( $function ) {
				$function();
			}
		);
	}

	/**
	 * Access the wp_enqueue_scripts action via shortcut function
	 *
	 * @param function $function the function called by the action.
	 * @return void
	 */
	private function action_enqueue_scripts( $function ) {
		add_action(
			'wp_enqueue_scripts',
			function() use ( $function ) {
				$function();
			}
		);
	}

	/**
	 * Access the widgets_init action via shortcut function
	 *
	 * @param function $function the function called by the action.
	 * @return void
	 */
	private function action_widget_init( $function ) {
		add_action(
			'widgets_init',
			function() use ( $function ) {
				$function();
			}
		);
	}

	/**
	 * The constructor function for the starter theme class.
	 *
	 * @param string $theme_name the theme name.
	 * @param string $theme_version the theme version number.
	 */
	public function __construct( $theme_name, $theme_version ) {
		// set the private variables.
		$this->theme_name    = $theme_name;
		$this->theme_version = $theme_version;
		// Let WordPress manage the document title (meaning, add the <title> tag to the document head).
		$this->add_theme_support( 'title-tag' );
		// Allow post thumbnails on posts & pages.
		$this->add_theme_support( 'post-thumbnails' );
		// Allow a custom logo to be uploaded via the customizer.
		$this->add_theme_support( 'custom-logo' );
		// Support the refresh of widget previews without fully reloading.
		$this->add_theme_support( 'customize-selective-refresh-widgets' );
		// Support HTML5 markup on built-in elements.
		$this->add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// setup ACF JSON support.
		add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );
	}

	/**
	 * Add theme support for a specified feature.
	 *
	 * @param string $feature the feature to add support for.
	 * @param array  $options any related options.
	 * @return object
	 */
	public function add_theme_support( $feature, $options = null ) {
		$this->action_after_setup(
			function() use ( $feature, $options ) {
				if ( $options ) {
					add_theme_support( $feature, $options );
				} else {
					add_theme_support( $feature );
				}
			}
		);

		return $this;
	}

	/**
	 * Remove theme support for a specified feature
	 *
	 * @param string $feature the feature name to remove support for.
	 * @return object
	 */
	public function remove_theme_support( $feature ) {
		$this->action_after_setup(
			function() use ( $feature ) {
				remove_theme_support( $feature );
			}
		);

		return $this;
	}

	/**
	 * Make the theme available for translation
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @param string $domain the language domain.
	 * @param string $path the path to the language file.
	 * @return object
	 */
	public function load_text_domain( $domain, $path = false ) {
		$this->action_after_setup(
			function() use ( $domain, $path ) {
				load_theme_textdomain( $domain, $path );
			}
		);

		return $this;
	}

	/**
	 * Add a new supported image size to the site.
	 *
	 * @param string  $name the name of the image size.
	 * @param integer $width the width of the image.
	 * @param integer $height the height of the image.
	 * @param boolean $crop whether or not to crop the image.
	 * @return object
	 */
	public function add_image_size( $name, $width = 0, $height = 0, $crop = false ) {
		$this->action_after_setup(
			function() use ( $name, $width, $height, $crop ) {
				add_image_size( $name, $width, $height, $crop );
			}
		);

		return $this;
	}

	/**
	 * Remove a supported image size
	 *
	 * @param string $name the name of the image size to remove.
	 * @return object
	 */
	public function remove_image_size( $name ) {
		$this->action_after_setup(
			function() use ( $name ) {
				remove_image_size( $name );
			}
		);

		return $this;
	}

	/**
	 * Enqueue a stylesheet
	 *
	 * @param string $handle the name of the stylesheet.
	 * @param string $src the url of the stylesheet.
	 * @param array  $deps any stylesheet dependencies to load first.
	 * @param string $media supported stylesheet media.
	 * @return object
	 */
	public function add_style( $handle, $src = '', $deps = array(), $media = 'all' ) {
		$this->action_enqueue_scripts(
			function() use ( $handle, $src, $deps, $media ) {
				wp_enqueue_style( $handle, $src, $deps, $this->theme_version, $media );
			}
		);

		return $this;
	}

	/**
	 * Enqueue a script
	 *
	 * @param string  $handle the name of the script.
	 * @param string  $src the url of the script.
	 * @param array   $deps any dependencies to load first.
	 * @param boolean $in_footer whether to load in head or footer.
	 * @return object
	 */
	public function add_script( $handle, $src = '', $deps = array(), $in_footer = true ) {
		$this->action_enqueue_scripts(
			function() use ( $handle, $src, $deps, $in_footer ) {
				wp_enqueue_script( $handle, $src, $deps, $this->theme_version, $in_footer );
			}
		);

		return $this;
	}


	/**
	 * A function to enqueue the polyfill script with the features needed by the theme
	 *
	 * @param array $features the special features to add.
	 * @return object
	 */
	public function add_polyfill_script( $features = array() ) {
		$polyfill_url = 'https://polyfill.io/v3/polyfill.min.js?features=default';
		if ( count( $features ) > 0 ) {
			foreach ( $features as $feature ) {
				$polyfill_url .= rawurlencode( '&' . $feature );
			}
		}

		$this->add_script( 'polyfill', $polyfill_url, array(), false );
		return $this;
	}

	/**
	 * Enqueue the greensock timeline max library for animations.
	 *
	 * @return void
	 */
	public function add_greensock_script() {
		$this->add_script( 'greensock', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js', array(), true );
	}

	/**
	 * Enqueue the slick slider library
	 *
	 * @return void
	 */
	public function add_slick_slider_script() {
		$this->add_script( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), true );
	}

	/**
	 * Enqueue the mixitup library
	 *
	 * @return void
	 */
	public function add_mixitup_script() {
		$this->add_style( 'mixitup', 'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css', array() );
		$this->add_script( 'mixitup', 'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js', array(), true );
	}

	/**
	 * Enqueue the magnific popup library
	 *
	 * @return void
	 */
	public function add_magnific_script() {
		$this->add_style( 'magnific', 'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css', array() );
		$this->add_script( 'magnific', 'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js', array(), true );
	}

	/**
	 * Remove an enqueued style
	 *
	 * @param string $handle the name of the style.
	 * @return object
	 */
	public function remove_style( $handle ) {
		$this->action_enqueue_scripts(
			function() use ( $handle ) {
				wp_dequeue_style( $handle );
				wp_deregister_style( $handle );
			}
		);

		return $this;
	}

	/**
	 * Remove an enqueued script
	 *
	 * @param string $handle the name of the script.
	 * @return object
	 */
	public function remove_script( $handle ) {
		$this->action_enqueue_scripts(
			function() use ( $handle ) {
				wp_dequeue_script( $handle );
				wp_deregister_script( $handle );
			}
		);

		return $this;
	}

	/**
	 * Add the specified navigation menus to the site.
	 *
	 * @param array $locations the existing menu locations.
	 * @return object
	 */
	public function add_nav_menus( $locations = array() ) {
		$this->action_after_setup(
			function() use ( $locations ) {
				register_nav_menus( $locations );
			}
		);

		return $this;
	}

	/**
	 * Add the specified navigation menu to the site.
	 *
	 * @param string $location the existing menu locations.
	 * @param string $description the name of the menu.
	 * @return object
	 */
	public function add_nav_menu( $location, $description ) {
		$this->action_after_setup(
			function() use ( $location ) {
				register_nav_menu( $location, $description );
			}
		);

		return $this;
	}

	/**
	 * Remove a nav menu
	 *
	 * @param string $location the menu location to remove.
	 * @return object
	 */
	public function remove_nav_menu( $location ) {
		$this->action_after_setup(
			function() use ( $location ) {
				unregister_nav_menu( $location );
			}
		);

		return $this;
	}

	/**
	 * Register a new sidebar
	 *
	 * @param array $sidebar_data the labels, etc. for the sidebar.
	 * @return object
	 */
	public function add_sidebar( $sidebar_data = array() ) {
		$this->action_widget_init(
			function() use ( $sidebar_data ) {
				register_sidebar( $sidebar_data );
			}
		);

		return $this;
	}

	/**
	 * Remove an existing sidebar
	 *
	 * @param string $id the ID the sidebar was registered with.
	 * @return object
	 */
	public function remove_sidebar( $id = '' ) {
		$this->action_widget_init(
			function() use ( $id ) {
				unregister_sidebar( $id );
			}
		);

		return $this;
	}

	/**
	 * Register a new widget
	 *
	 * @param string $widget_class the name of the widget class to register.
	 * @return object
	 */
	public function add_widget( $widget_class ) {
		$this->action_widget_init(
			function() use ( $widget_class ) {
				register_widget( $widget_class );
			}
		);

		return $this;
	}

	/**
	 * Remove a widget
	 *
	 * @param string $widget_class the name of the widget class to remove.
	 * @return object
	 */
	public function remove_widget( $widget_class ) {
		$this->action_widget_init(
			function() use ( $widget_class ) {
				unregister_widget( $widget_class );
			}
		);

		return $this;
	}

	/**
	 * Set a custom directory to save ACF JSON files
	 *
	 * @param string $path the original directory for the JSON files.
	 * @return string
	 */
	public function custom_acf_json_save_point( $path ) {
		$path = get_stylesheet_directory() . '/fields';

		return $path;
	}
}
