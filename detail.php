<?php
/* Template name: Detail */

// Load necessary UIkit components.
add_action( 'beans_uikit_enqueue_scripts', 'detail_view_enqueue_uikit_assets' );

function detail_view_enqueue_uikit_assets() {

	beans_uikit_enqueue_components( array( 'flex', 'animation', 'contrast', 'overlay', 'thumbnail', 'modal', 'scrollspy', 'smooth-scroll', 'tab' ), 'core' );
	beans_uikit_enqueue_components( array( 'lightbox', 'slider', 'slideshow', 'accordion', 'slideshow-fx', 'sticky', 'tooltip', 'progress', 'modal', 'offcanvas' ), 'add-ons' );

}

// Force layout.
add_filter( 'beans_layout', 'detail_force_layout' );

function detail_force_layout() {

    return 'c';

}

// Remove comment div.
beans_remove_action( 'beans_comments_template' );

// Load document which is always needed at the bottom of template files.
beans_load_document();