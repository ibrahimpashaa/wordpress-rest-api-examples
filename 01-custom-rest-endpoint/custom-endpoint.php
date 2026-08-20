<?php

// Prevent direct access to this file outside WordPress.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register our custom endpoint when the WordPress REST API initializes.
add_action( 'rest_api_init', function () {

    // Create the custom REST API route:
    // /wp-json/ibrahim/v1/message
    register_rest_route(
        'ibrahim/v1', // Custom namespace and API version.
        '/message',    // Custom endpoint route.
        array(

            // Allow GET requests to this endpoint.
            'methods' => 'GET',

            // Run this callback when the endpoint is requested.
            'callback' => 'ibrahim_get_message',

            // Allow public access to this endpoint.
            'permission_callback' => '__return_true',

        )
    );

} );

// Custom callback function for our REST API endpoint.
function ibrahim_get_message() {

    // Return a JSON response to the client.
    return new WP_REST_Response(
        array(
            'success' => true,
            'message' => 'Hello from my custom WordPress REST API endpoint!',
        ),
        200
    );
}
