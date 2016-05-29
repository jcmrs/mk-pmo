<?php
/* Template name: Start */

// Load necessary UIkit components.
add_action( 'beans_uikit_enqueue_scripts', 'start_view_enqueue_uikit_assets' );

function start_view_enqueue_uikit_assets() {

	beans_uikit_enqueue_components( array( 'flex', 'animation', 'contrast', 'overlay', 'thumbnail', 'modal', 'scrollspy', 'smooth-scroll', 'tab' ), 'core' );
	beans_uikit_enqueue_components( array( 'lightbox', 'slider', 'slideshow', 'accordion', 'slideshow-fx', 'sticky', 'tooltip', 'progress', 'modal', 'offcanvas' ), 'add-ons' );

}

function beans_child_view_force_layout( $args ) {

	return 'c';

}

// Remove comment div.
beans_remove_action( 'beans_comments_template' );

// Register Post Meta
add_action( 'admin_init', 'start_register_post_meta', 8 );

function start_register_post_meta() {

    $fields = array(
        array(
            'id' => 'beans_child_hero_image',
            'label' => __( 'Hero Image', 'beans-child' ),
            'type' => 'image'
        ),
        array(
            'id' => 'beans_child_hero_title',
            'label' => __( 'Hero Title', 'beans-child' ),
            'type' => 'text'
        ),
        array(
            'id' => 'beans_child_hero_button_text',
            'label' => __( 'Hero Button Text', 'beans-child' ),
            'type' => 'text'
        ),
        array(
            'id' => 'beans_child_hero_button_href',
            'label' => __( 'Hero Button Link', 'beans-child' ),
            'type' => 'text'
        )
    );

    beans_register_post_meta( $fields, array( 'post', 'page' ), 'beans-child-hero', array( 'title' => __( 'Hero Content', 'beans-child' ) ) );

}

// 

// Add Hero from registered post meta.
add_action( 'beans_header_after_markup', 'start_hero' );

function start_hero() {

    // Stop here if not image is set. We use get_queried_object to get the right id if a page is assigned to Blog Posts.
    if ( !$image_id = beans_get_post_meta( 'beans_child_hero_image', false, beans_get( 'ID', get_queried_object() ) ) )
        return;

    $image = wp_get_attachment_image_src( $image_id, 'full' );

    // Stop here if the image doesn't exist.
    if ( empty( $image[0] ) )
        return;

    ?>
    <div class="tm-hero uk-cover uk-position-relative">
        <img class="uk-width-1-1" src="<?php echo esc_url( $image[0] ); ?>" width="<?php echo esc_attr( $image[1] ); ?>" height="<?php echo esc_attr( $image[2] ); ?>">
        <div class="uk-position-cover uk-flex uk-flex-center uk-flex-middle">
            <div class="uk-text-center uk-contrast">
            <?php if ( $title = beans_get_post_meta( 'beans_child_hero_title' ) ) : ?>
                <h1><?php echo esc_html( $title ); ?></h1>
            <?php endif; ?>
            <?php if ( $button_text = beans_get_post_meta( 'beans_child_hero_button_text' ) ) : ?>
                <p><a class="uk-button uk-button-primary uk-button-large" href="<?php echo esc_url( beans_get_post_meta( 'beans_child_hero_button_href' ) ); ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_attr( $button_text ); ?></a></p>
            <?php endif; ?>
            </div>
        </div>
    </div>
    <?php

}

// Load document which is always needed at the bottom of template files.
beans_load_document();