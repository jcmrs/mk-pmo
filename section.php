<?php
/* Template name: Section */

// Load necessary UIkit components.
add_action( 'beans_uikit_enqueue_scripts', 'section_view_enqueue_uikit_assets' );

function section_view_enqueue_uikit_assets() {

	beans_uikit_enqueue_components( array( 'flex', 'animation', 'contrast', 'overlay', 'thumbnail', 'modal', 'scrollspy', 'smooth-scroll', 'tab' ), 'core' );
	beans_uikit_enqueue_components( array( 'lightbox', 'slider', 'slideshow', 'accordion', 'slideshow-fx', 'sticky', 'tooltip', 'progress', 'modal', 'offcanvas' ), 'add-ons' );

}

// Remove comment div.
beans_remove_action( 'beans_comments_template' );

// Load document which is always needed at the bottom of template files.
beans_load_document();