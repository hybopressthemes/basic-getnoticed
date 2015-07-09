<?php

add_action( 'after_setup_theme', 'child_theme_setup_before_parent', 0 );
add_action( 'after_setup_theme', 'child_theme_setup1', 11 );
add_action( 'after_setup_theme', 'child_theme_setup2', 14 );

add_filter( 'body_class', 'child_theme_body_specific_classes', 11 );

function child_theme_setup_before_parent() {
	if ( ! defined( 'SCRIPT_DEBUG' ) ) {
		define( 'SCRIPT_DEBUG', false );
	}

	//define( 'HYBOPRESS_NO_OF_FOOTER_WIDGET_ROWS', 1 );
}

function child_theme_setup1() {

	// Register site styles and scripts
	add_action( 'wp_enqueue_scripts', 'child_theme_register_styles' );

	// Enqueue site styles and scripts
	add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );
	add_filter( 'hybopress_use_cache', 'child_theme_use_cache' );

}

function child_theme_use_cache( $use_cache ) {
	return true;
}

function child_theme_body_specific_classes( $classes ) {

	foreach( $classes as $key => $value ) {
		if ( $value == 'use-hyphens' ) {
			unset( $classes[$key] );
		}
	}

	return $classes;
}

function child_theme_setup2() {
	//removing featured image
	remove_action( 'hybopress_the_featured_image', 'hybopress_do_the_featured_image' );

	//adding above Header of entry
	add_action( 'hybopress_entry', 'hybopress_do_the_featured_image', 5 );

	remove_action( 'hybopress_before_comments', 'hybopress_before_comments_markup_open', 5 );
	add_action( 'hybopress_before_comment_form', 'hybopress_before_comments_markup_open', 5 );

	add_action( 'hybopress_before_comment_form', 'child_theme_comment_policy', 6 );

	remove_action( 'hybopress_after_comment_form', 'hybopress_after_comments_markup_close', 5 );
	add_action( 'hybopress_after_pings', 'hybopress_after_comments_markup_close', 5 );

	add_filter( 'hybopress_comment_form_class_submit', 'child_theme_comment_form_class_submit' );
	//add_filter( 'hybopress_comments_title', 'child_theme_comments_title' );

}

function child_theme_register_styles() {

	wp_register_style( 'child-fonts', '//fonts.googleapis.com/css?family=Arimo:400,700|Abel:400|Rokkitt:400,700' );

	$main_styles = trailingslashit( CHILD_THEME_URI ) . "assets/css/child-style.css";

	wp_register_style(
		sanitize_key(  'child-style' ), esc_url( $main_styles ), array( 'skin' ), PARENT_THEME_VERSION, esc_attr( 'all' )
	);

}

function child_theme_enqueue_styles() {
	wp_enqueue_style( 'child-fonts' );
	wp_enqueue_style( 'child-style' );
}


function child_theme_comment_policy() {
	printf( '<div id="%1$s" class="%1$s">', 'comments-policy' );

		printf( '<p>' );

			echo __( 'Please note: I reserve the right to delete comments that are offensive or off-topic.', 'getnoticed' );

		echo '</p>';

	echo '</div>';
}


function child_theme_comment_form_class_submit( $class_submit ) {

	$class_submit = str_replace( 'btn-primary', 'btn-default', $class_submit );

	return $class_submit;
}

function child_theme_comments_title( $comments_title ) {

	//$comments_title = 'Thoughts on' . '<span>' . get_the_title() . '</span>';

	//comments_popup_link( false, false, false, 'comments-link' );

	return $comments_title;
}

