<?php
class BeerReviewsUtility {
    public static function fetch_beer_reviews_data($settings) {
        $client_id = $settings['client_id'] ?? '';
        $client_secret = $settings['client_secret'] ?? '';
        $beer_id = $settings['beer_id'] ?? '110569';

        // Create transient name
        $transient_name = 'beer_reviews_data_' . $beer_id . '_' . md5(serialize($settings));

        // Attempt to retrieve cached data
        $cached_data = get_transient($transient_name);

        if (false === $cached_data) {
            // Data is not cached, make API request
            $api_url = 'https://api.untappd.com/v4/beer/info/' . $beer_id . '/?client_id=' . $client_id . '&client_secret=' . $client_secret;
            $response = wp_remote_get($api_url);

            if (is_array($response) && !is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $beer_reviews_data = json_decode($body, true);

                // Cache the data for 15 minutes to avoid hitting the API on every page load
				set_transient($transient_name, $beer_reviews_data, 15 * MINUTE_IN_SECONDS);

                return $beer_reviews_data;
            }

            return array(); // API request failed, return an empty array
        }

        // Existing data cached, return it
        return $cached_data;
    }
}
