<?php

// Prevent direct access outside WordPress.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register the custom posts endpoint when the REST API initializes.
add_action( 'rest_api_init', function () {

    // Register the custom posts route.
    register_rest_route(
        'ibrahim/v1', // Custom namespace and API version.
        '/posts',      // Custom endpoint route.
        array(
            'methods'             => 'GET',
            'callback'            => 'ibrahim_get_posts',
            'permission_callback' => '__return_true',
        )
    );

} );

// Custom callback function for the posts endpoint.
function ibrahim_get_posts() {

    // Get published WordPress posts.
    $posts = get_posts(
        array(
            'post_type'   => 'post',
            'post_status' => 'publish',
            'numberposts' => 5,
        )
    );

    // Create an empty array for the API response data.
    $results = array();

    // Loop through each WordPress post one at a time.
    foreach ( $posts as $post ) {

        // Add selected information from the current post.
        $results[] = array(
            'id'    => $post->ID,
            'title' => $post->post_title,
            'url'   => get_permalink( $post->ID ),
        );
    }

    // Return the cleaned post data as JSON.
    return new WP_REST_Response(
        array(
            'success' => true,
            'posts'   => $results,
        ),
        200
    );
}
