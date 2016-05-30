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

// Alternate Replace default Footer Content.
// Issue: not applying tm-main to footer itself. Apply to beans_footer instead of footer_content yes/no
beans_modify_action_callback( 'beans_footer_content', 'section_child_footer_content' );
function section_child_footer_content() {

    ?>
    <div class="uk-grid uk-container-center uk-text-small" data-uk-grid-margin>
        <div class="uk-width-large-1-1 uk-text-center">
            <p class="uk-text-muted"><a class="mk-top href="#mk-top" title="Terug naar boven" data-uk-smooth-scroll><i class="uk-icon-arrow-up"></i> Top</a></p>
        </div>
    </div>
    <?php
}

// Load document which is always needed at the bottom of template files.
beans_load_document();