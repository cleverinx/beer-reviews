=== Untappd Beer Reviews ===

Contributors: davera
Tags: comments, spam
Requires at least: 4.2
Tested up to: 4.7.2
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A Wordpress plugin to show the latest reviews and beer information using untappd.com API using a shortcode.

== Description ==


### Getting Started:

Configure your Untappd API Client ID and Client Secret in the Settings area.

Use the `[beer-reviews]` shortcode to display the latest beer reviews wherever you want on your site.

### Changing Settings:

You can customize the behavior of the plugin by changing the settings in the Settings area. Here's how:

To change the reviews displayed for a specific beer, enter the beer ID in the settings. You can find the beer ID in the URL of the beer's page on Untappd.com.

In the settings, you can also choose whether to display user avatars and user reviews with the beer information.

### Displaying Different Beer Reviews:

If you want to display different beer reviews on different areas of your site, you can use the id attribute with the `[beer-reviews]` shortcode.

For example: `[beer-reviews id='29957']`. Replace '29957' with the beer ID of the specific beer you want to display.

### Finding Beer IDs:

To find the beer ID, simply take the last digits from a beer's URL on Untappd.com. For example, if the beer's URL is https://untappd.com/b/garrison-brewing-company-irish-red-ale/29957, the beer ID is '29957'.




== Installation ==

Install the zip file via the WordPress plugin uploader, or unzip the file and upload the `beer-reviews` folder to the `/wp-content/plugins/` directory



== Changelog ==

= 1.0 =
* Initial launch
