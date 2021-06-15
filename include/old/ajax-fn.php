<?php
/*
    WordPress Ajax utility functions
*/
function get_post_content_by_ajax_callback() {

    // retrieve post_id, and sanitize it to enhance security
    $post_id = intval( $_POST['post_id'] );

    // Check if the input was a valid integer
    if ( $post_id == 0 ) {
        echo "Invalid Input";
        die();
    }

    // get the post
    $thispost = get_post( $post_id );

    // check if post exists
    if ( !is_object( $thispost ) ) {
        echo 'There is no post with the ID ' . $post_id;
        die();
    }

    $thispost->post_content = apply_filters( 'the_content', $thispost->post_content);

    echo json_encode($thispost); // Maybe you want to echo wpautop( $thispost->post_content );

    die();

}
add_action( 'wp_ajax_get_post_content_by_ajax', 'get_post_content_by_ajax_callback' );
add_action( 'wp_ajax_nopriv_get_post_content_by_ajax', 'get_post_content_by_ajax_callback' );
