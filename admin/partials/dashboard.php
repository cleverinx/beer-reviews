<div class="wrap beer-reviews-admin">
    <div class="container">
    <?php $heading = $heading ?? 'Untappd Beer Reviews'; ?>
        <h1><?php echo $heading; ?></h1>
		<?php
		$settings_link = admin_url( 'admin.php?page=' . $this->plugin_slug . '-settings' );
		?>


        <h2>Introduction:</h2>
        <p>Welcome to the Beer Reviews Plugin for WordPress! This plugin allows you to display the latest 10 beer
            reviews from Untappd.com along with basic information about the beer on your WordPress site.</p>

        <h3>Getting Started:</h3>

        <p>Configure your Untappd API Client ID and Client Secret in the <a href="<?php echo $settings_link; ?>">Settings</a> area.</p>


        <p>Use the <code>[beer-reviews]</code> shortcode to display the latest beer reviews wherever you want on your
            site.</p>

        <h3>Changing Settings:</h3>
        <p>You can customize the behavior of the plugin by changing the settings in the <a
                    href="<?php echo $settings_link; ?>">Settings</a> area. Here's how:</p>

        <p>To change the reviews displayed for a specific beer, enter the beer ID in the settings. You can find the beer
            ID in the URL of the beer's page on Untappd.com.</p>

        <p>In the settings, you can also choose whether to display user avatars and user reviews with the beer
            information.</p>

        <p>Displaying Different Beer Reviews:</p>
        <p>If you want to display different beer reviews on different areas of your site, you can use the id attribute
            with the <code>[beer-reviews]</code> shortcode.</p>
        <p>For example: <code>[beer-reviews id='29957']</code>. Replace '29957' with the beer ID of the specific beer
            you want to display.</p>

        <h3>Finding Beer IDs:</h3>
        <p>To find the beer ID, simply take the last digits from a beer's URL on Untappd.com. For example, if the beer's
            URL is https://untappd.com/b/garrison-brewing-company-irish-red-ale/29957, the beer ID is '29957'.</p>

        <h3>Support:</h3>
        <p>If you encounter any issues or have questions about using this plugin, feel free to reach out to us for
            support.</p>
    </div>
</div>