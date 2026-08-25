<?php

// Prevent direct access outside WordPress.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register the single-post endpoint when the REST API initializes.
add_action( 'rest_api_init', function () {

    // Register a route that accepts a dynamic post ID.
    register_rest_route(
        'ibrahim/v1',
        '/posts/(?P<id>\d+)',
        array(
            'methods'             => 'GET',
            'callback'            => 'ibrahim_get_single_post',
            'permission_callback' => '__return_true',
        )
    );

} );

// Custom callback function for retrieving one post.
function ibrahim_get_single_post( $request ) {

    // Get the post ID from the REST API URL.
    $post_id = (int) $request['id'];

    // Retrieve the WordPress post using the captured ID.
    $post = get_post( $post_id );

    // Return a 404 response if the requested post does not exist.
    if ( ! $post ) {

        return new WP_REST_Response(
            array(
                'success' => false,
                'message' => 'Post not found.',
            ),
            404
        );
    }

    // Make sure the requested resource is a published WordPress post.
    if ( 'post' !== $post->post_type || 'publish' !== $post->post_status ) {

        return new WP_REST_Response(
            array(
                'success' => false,
                'message' => 'Post is not publicly available.',
            ),
            404
        );
    }

    // Return the selected post data as a successful REST API response.
    return new WP_REST_Response(
        array(
            'success' => true,
            'post'    => array(
                'id'      => $post->ID,
                'title'   => $post->post_title,
                'url'     => get_permalink( $post->ID ),
                'excerpt' => get_the_excerpt( $post->ID ),
            ),
        ),
        200
    );
}
