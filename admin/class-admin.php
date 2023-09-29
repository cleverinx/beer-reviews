<?php

namespace Beer_Reviews;

/**
 * The code used in the admin.
 */
class Admin
{
    private $plugin_slug;
    private $version;
    private $option_name;
    private $settings;
    private $settings_group;

    public function __construct($plugin_slug, $version, $option_name) {
        $this->plugin_slug = $plugin_slug;
        $this->version = $version;
        $this->option_name = $option_name;
        $this->settings = get_option($this->option_name);
        $this->settings_group = $this->option_name.'_group';
    }

    /**
     * Generate settings fields by passing an array of data (see the render method).
     *
     * @param array $field_args The array that helps build the settings fields
     * @param array $settings   The settings array from the options table
     *
     * @return string The settings fields' HTML to be output in the view
     */
    private function custom_settings_fields($field_args, $settings) {
        $output = '';

        foreach ($field_args as $field) {

            $slug = $field['slug'];
	        $value = $settings[ $slug ] ?? '';
            $setting = $this->option_name.'['.$slug.']';
            $label = esc_attr__($field['label'], $this->plugin_slug);
            $output .= '<h3><label for="'.$setting.'">'.$label.'</label></h3>';

            if ($field['type'] === 'text') {
                $output .= '<p><input type="text" id="'.$setting.'" name="'.$setting.'" value="'.$value.'"></p>';
            }
			elseif ($field['type'] === 'password') {
				$output .= '<p><input type="password" id="'.$setting.'" name="'.$setting.'" value="'.$value.'"></p>';
			}

        }

        return $output;
    }

    public function assets() {
        wp_enqueue_style($this->plugin_slug, plugin_dir_url(__FILE__) . 'css/beer-reviews-admin.css', [], $this->version);
        wp_enqueue_script($this->plugin_slug, plugin_dir_url(__FILE__) . 'js/beer-reviews-admin.js', ['jquery'], $this->version, true);
    }

    public function register_settings() {
        register_setting($this->settings_group, $this->option_name);
    }

    public function add_menus() {
        $plugin_name = Info::get_plugin_title();
add_menu_page(
	$plugin_name,
	'Beer Reviews',
	'manage_options',
	$this->plugin_slug,
	[$this, 'render_dashboard']
);

        add_submenu_page(
            $this->plugin_slug,
			'Beer Reviews Settings',
			'Settings',
            'manage_options',
            $this->plugin_slug.'-settings',
			[$this, 'render']
        );

    }

    /**
     * Render the view using MVC pattern.
     */


	public function render_dashboard() {
		//generate the dashboard
		 $settings = $this->settings; //NOSONAR

		$heading = Info::get_plugin_title();  //NOSONAR
		require_once plugin_dir_path(dirname(__FILE__)).'admin/partials/dashboard.php';
	}
    public function render() {

        // Generate the settings fields
        $field_args = [
					[
				'slug' => 'client_id',
				'label' => 'Untappd Client ID',
				'type' => 'text',
			],
	        		[
				'slug' => 'client_secret',
				'label' => 'Untappd Client ID',
				'type' => 'password',
			],
			[
				'slug' => 'text',
				'label' => 'Beer ID',
				'type' => 'text',
			],
        ];

        // Model
        $settings = $this->settings;

        // Controller

        $fields = $this->custom_settings_fields($field_args, $settings);  //NOSONAR
        $settings_group = $this->settings_group;  //NOSONAR
        $heading = Info::get_plugin_title() . ' Settings';  //NOSONAR
        $submit_text = esc_attr__('Submit', $this->plugin_slug);  //NOSONAR
	    $page_slug = $this->plugin_slug . '-settings';  //NOSONAR



        // View
        require_once plugin_dir_path(dirname(__FILE__)).'admin/partials/view.php';
    }
}
