<?php
/* Template name: Start */

// Load necessary UIkit components.
add_action( 'beans_uikit_enqueue_scripts', 'pmo_view_enqueue_uikit_assets' );

function pmo_view_enqueue_uikit_assets() {

	beans_uikit_enqueue_components( array( 'flex', 'animation', 'contrast', 'overlay', 'thumbnail', 'modal', 'scrollspy', 'smooth-scroll', 'tab' ), 'core' );
	beans_uikit_enqueue_components( array( 'lightbox', 'slider', 'slideshow', 'accordion', 'slideshow-fx', 'sticky', 'tooltip', 'progress', 'modal', 'offcanvas' ), 'add-ons' );

}

add_action( 'beans_uikit_enqueue_scripts', 'beans_child_enqueue_uikit_assets' );

function beans_child_enqueue_uikit_assets() {

    beans_compiler_add_fragment( 'uikit', get_stylesheet_directory_uri() . '/style.less', 'less' );

}

// Remove comment and content div for typography page.
beans_remove_action( 'beans_comments_template' );

// Load document which is always needed at the bottom of template files.
beans_load_document();