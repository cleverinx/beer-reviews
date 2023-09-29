<?php

namespace Beer_Reviews;

use BeerReviewsUtility;

/**
 * The code used on the frontend.
 */
class Frontend
{
    private $plugin_slug;
    private $version;
    private $option_name;
    private $settings;

    public function __construct($plugin_slug, $version, $option_name) {
        $this->plugin_slug = $plugin_slug;
        $this->version = $version;
        $this->option_name = $option_name;
        $this->settings = get_option($this->option_name);
    }

    public function assets() {
        wp_enqueue_style($this->plugin_slug, plugin_dir_url(__FILE__) . 'css/beer-reviews-frontend.css', [], $this->version);
        wp_enqueue_script($this->plugin_slug, plugin_dir_url(__FILE__) . 'js/beer-reviews-frontend.js', ['jquery'], $this->version, true);
    }

	  public function register_shortcodes()
    {

        add_shortcode("beer-reviews", array( $this,"beer_reviews_handler"));
    } // register_shortcodes()

	 public function beer_reviews_handler($atts)
	{
		$atts = shortcode_atts(array(
			'id' => '1',
		), $atts, 'beer-reviews');
		$id = $atts['id']; //NOSONAR

		$data = BeerReviewsUtility::fetch_beer_reviews_data($this->settings); //NOSONAR

		ob_start();
		include_once plugin_dir_path(dirname(__FILE__)).'frontend/partials/view.php';
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
        if (locate_template('partials/' . $this->plugin_slug . '.php')) {
            require_once(locate_template('partials/' . $this->plugin_slug . '.php'));
        } else {
            require_once plugin_dir_path(dirname(__FILE__)).'frontend/partials/view.php';
        }
    }
}
