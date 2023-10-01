<?php

namespace Beer_Reviews;

use BeerReviewsUtility;

/**
 * The code used on the frontend.
 */
class Frontend {
	private $plugin_slug;
	private $version;
	private $option_name;
	private $settings;


	public function __construct( $plugin_slug, $version, $option_name ) {
		$this->plugin_slug = $plugin_slug;
		$this->version     = $version;
		$this->option_name = $option_name;
		$this->settings    = get_option( $this->option_name );
	}

	public function assets() {
		wp_enqueue_style( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'css/beer-reviews-frontend.css', [], $this->version );

		wp_enqueue_script( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'js/beer-reviews-frontend.js', [ 'jquery' ], $this->version, true );
		wp_enqueue_script( 'lucide-icons', 'https://unpkg.com/lucide@latest', [], $this->version, true );


	}

	public function register_shortcodes() {

		add_shortcode( "beer-reviews", array( $this, "beer_reviews_handler" ) );
	} // register_shortcodes()


	public static function generate_star_rating( $rating ) {

		$rating_html = '<div class="star-rating">';
		$full_stars  = floor( $rating ); // Number of full stars
		$half_star   = ceil( $rating - $full_stars ); // 0 or 1 for half-star

		for ( $i = 0; $i < $full_stars; $i ++ ) {
			$rating_html .= '<i data-lucide="star"></i>';
		}

		if ( $half_star == 1 ) {
			$rating_html .= '<span class="half-star"><i data-lucide="star" class="empty"></i><i data-lucide="star-half" class="half"></i></span>';
		}


		$empty_stars = 5 - $full_stars - $half_star;
		for ( $i = 0; $i < $empty_stars; $i ++ ) {
			$rating_html .= '<i data-lucide="star" class="empty"></i>';
		}

		$rating_html .= '</div>';

		return $rating_html;
	}

	public function beer_reviews_handler( $atts ) {
		$atts = shortcode_atts( array(
			'id' => '',
		), $atts, 'beer-reviews' );

		$id   = $atts['id']; //NOSONAR
		// if id exists and is not empty, use it for the beer id
		if ( ! empty( $id ) ) {
			$this->settings['beer_id'] = $id;
		}


		$show_reviews = $this->settings['show_reviews'] ?? ''; //NOSONAR
		$show_avatar  = $this->settings['show_avatar'] ?? ''; //NOSONAR

		$data = BeerReviewsUtility::fetch_beer_reviews_data( $this->settings ); //NOSONAR

		ob_start();
		include_once plugin_dir_path( dirname( __FILE__ ) ) . 'frontend/partials/view.php';

		return ob_get_clean();


	} // beer_reviews_handler()


	/**
	 * Render the view using MVC pattern.
	 */
	public function render() {

		// Model
		$settings = $this->settings; //NOSONAR

		// Controller
		// Declare vars like so:
		// $var = $settings['slug'] ?? '';

		// View
		if ( locate_template( 'partials/' . $this->plugin_slug . '.php' ) ) {
			require_once( locate_template( 'partials/' . $this->plugin_slug . '.php' ) );
		} else {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'frontend/partials/view.php';
		}
	}
}
