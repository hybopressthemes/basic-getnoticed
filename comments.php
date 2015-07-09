<?php

/* Kill the page if trying to access this template directly. */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( __( 'Please do not load this page directly. Thanks!', 'getnoticed' ) );
}

if ( post_password_required() ) {
	printf( '<p class="alert alert-warning">%s</p>', __( 'This post is password protected. Enter the password to view comments.', 'getnoticed' ) );
	return;
}

/* If a post has no comments and/or comments/pings are closed, return. */

/*
Note: Temporarily disabled
if ( !have_comments() && !comments_open() && !pings_open() ) {
	return;
}
*/

do_action( 'hybopress_before_comment_form' );
do_action( 'hybopress_comment_form' );
do_action( 'hybopress_after_comment_form' );

do_action( 'hybopress_before_comments' );
do_action( 'hybopress_comments' );
do_action( 'hybopress_after_comments' );

do_action( 'hybopress_before_pings' );
do_action( 'hybopress_pings' );
do_action( 'hybopress_after_pings' );



