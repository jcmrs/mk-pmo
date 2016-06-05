<?php

// Include Beans. Do not remove the line below.
require_once( get_template_directory() . '/lib/init.php' );

/*
 * Remove this action and callback function if you do not whish to use LESS to style your site or overwrite UIkit variables.
 * If you are using LESS, make sure to enable development mode via the Admin->Appearance->Settings option. LESS will then be processed on the fly.
 */
add_action( 'beans_uikit_enqueue_scripts', 'beans_child_enqueue_uikit_assets' );

function beans_child_enqueue_uikit_assets() {

	beans_compiler_add_fragment( 'uikit', get_stylesheet_directory_uri() . '/style.less', 'less' );
	
	beans_uikit_enqueue_components( array( 'flex', 'animation', 'contrast', 'overlay', 'thumbnail', 'modal', 'scrollspy', 'smooth-scroll', 'tab' ), 'core' );
	beans_uikit_enqueue_components( array( 'lightbox', 'slider', 'slideshow', 'accordion', 'slideshow-fx', 'sticky', 'tooltip', 'progress', 'modal', 'offcanvas' ), 'add-ons' );

}

// Remove this action and callback function if you are not adding CSS in the style.css file.
add_action( 'wp_enqueue_scripts', 'beans_child_enqueue_assets' );

function beans_child_enqueue_assets() {

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );

}

// Clean the Head.
remove_action(‘wp_head’, ‘rsd_link’); 
remove_action(‘wp_head’, ‘wp_generator’); 
remove_action(‘wp_head’, ‘feed_links’, 2); 
remove_action(‘wp_head’, ‘feed_links_extra’, 3); 
remove_action(‘wp_head’, ‘index_rel_link’);
remove_action(‘wp_head’, ‘wlwmanifest_link’); 
remove_action(‘wp_head’, ‘start_post_rel_link’, 10, 0); 
remove_action(‘wp_head’, ‘parent_post_rel_link’, 10, 0);
remove_action(‘wp_head’, ‘adjacent_posts_rel_link’, 10, 0);
remove_action(‘wp_head’, ‘adjacent_posts_rel_link_wp_head’, 10, 0 );
remove_action(‘wp_head’, ‘wp_shortlink_wp_head’, 10, 0 );
// remove_action(‘wp_head’, ‘rel_canonical’, 10, 0 );

// Disable any and all mention of emoji's.
// Source code credit: http://ottopress.com/
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );   
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );     
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

/*
 * Customisations start here.
 */

// Tweaking the site title tag text
beans_add_attribute( 'beans_site_title_tag', 'class', 'uk-text-center');
beans_add_attribute( 'beans_site_title_tag', 'class', 'uk-margin-top');
beans_add_attribute( 'beans_site_title_tag', 'class', 'uk-text-break');
beans_replace_attribute( 'beans_site_title_tag', 'class', 'uk-text-muted', 'uk-text-success' );
// beans_remove_attribute( 'beans_site_title_tag', 'class', 'uk-text-small' );

// Adding tel: link to beans_site_title_tag.
add_action( 'beans_site_title_tag_append_markup', 'mk_site_title_tag_append_markup' );

function mk_site_title_tag_append_markup() {

	echo ' - bel <a href="tel:1-562-867-5309">562-867-5309</a>';
	
}

// Add Header Bar
beans_add_smart_action( 'beans_header_before_markup', 'header_bar' );

function header_bar() {

	?>
	<div class="tm-header-bar uk-block-muted">
		
		
		<div class="uk-container uk-container-center uk-text-justify">
			
			<div class="uk-grid" data-uk-grid-match data-uk-margin>
    			<div class="uk-width-large-1-2 uk-width-medium-1-2 uk-text-middle uk-text-left uk-text-center-small uk-text-break">
    				<?php echo beans_site_title_tag(); ?> PMO voor werkgever, werknemer en zzp
    			</div>
    			<div class="uk-width-large-1-2 uk-width-medium-1-2 uk-text-right uk-text-middle uk-text-center-small">
    				<a href="#"><i class="uk-icon-map-marker"></i> Locaties</a> <a href="mailto:info@mail.net"><i class="uk-icon-envelope"></i> info @ mail.net</a> <a href="tel:1-562-867-5309"><i class="uk-icon-phone-square"></i> 562-867-5309</a>
    			</div>
			</div>
			
			
		</div>
		
	</div>
	<?php

}

// Add sticky to Navbar
beans_add_attribute( 'beans_header', 'data-uk-sticky', 'top:0' );

// Add Smooth Scroll.
add_action( 'beans_uikit_enqueue_scripts', 'smooth_scroll_enqueue_uikit_assets' );

function smooth_scroll_enqueue_uikit_assets() {

    beans_uikit_enqueue_components( array( 'smooth-scroll' ) );
    beans_compiler_add_fragment( 'uikit', get_stylesheet_directory() . '/style.less', 'less' );

}

// Add Back to Top. Figure out why it doesn't scroll back all the way to the top!
beans_add_attribute( 'beans_body', 'id', 'mk-top' );
// beans_add_attribute( 'tm_header_bar', 'id', 'mk-top' );

// Change default featured image size.

add_filter( 'beans_edit_post_image_args', 'example_post_image_edit_args' );

function example_post_image_edit_args( $args ) {

    return array_merge( $args, array(
        'resize' => array( 1200, 400, true ),
    ) );

}

add_filter( 'beans_edit_post_image_small_args', 'example_post_image_small_args' );

function example_post_image_small_args( $args ) {

    return array_merge( $args, array(
        'resize' => array( 800, 200, true ),
    ) );
    
}

// Add Related Content
// area beneath main content, seperated by gutter, used for related content function.

// Widget Area: CTA.
add_action( 'widgets_init', 'cta_widget_area' );

function cta_widget_area() {

    beans_register_widget_area( array(
        'name' => 'CTA',
        'id' => 'cta',
        'beans_type' => 'grid'
    ) );

}

// Display the CTA widget area in the front end.
add_action( 'beans_footer_before_markup', 'cta_footer_widget_area' );

function cta_footer_widget_area() {

	?>
	<div class="tm-main uk-block uk-padding-bottom-remove">
		<div class="tm-footer uk-block uk-block-primary">
			<div class="uk-container uk-container-center uk-contrast uk-text-center">
				<?php echo beans_widget_area( 'cta' ); ?>
			</div>
		</div>
	</div>
	<?php

}

// Replace default Footer Content.
// Issue: not applying tm-main to footer itself. Apply to beans_footer instead of footer_content yes/no
beans_modify_action_callback( 'beans_footer_content', 'beans_child_footer_content' );
function beans_child_footer_content() {

    ?>
    <div class="uk-grid uk-container-center uk-text-small" data-uk-grid-margin>
        <div class="uk-width-large-1-2 uk-width-small-1-2 uk-text-center">
            <p class="uk-text-muted">Copyright | Privacy | Sitemap</p>
        </div>

        <div class="uk-width-large-1-2 uk-width-small-1-2 uk-text-center uk-clearfix">
            <p class="uk-text-muted"><a class="mk-top href="#mk-top" title="Terug naar boven" data-uk-smooth-scroll><i class="uk-icon-arrow-up"></i> Top</a></p>
        </div>
    </div>
    <?php
}

/*
 * Customisations end here.
 */

/*
 * Testing functions.
 */

// Checking which UIkit components are loading. Fancy.
add_action( 'beans_body_append_markup', 'example_fancy_uikit_components' );

function example_fancy_uikit_components() {

    // Stop here if Beans is not in dev mode.
    if ( !get_option( 'beans_dev_mode', false ) ) {
        return;
    }

    global $_beans_uikit_enqueued_items;

    ?>
    <a href="#example-uikit-list" class="uk-button-text uk-float-right uk-margin-right uk-margin-bottom" data-uk-offcanvas=""><i class="uk-icon-cog uk-margin-small-right"></i>UIkit components</a>
    <div id="example-uikit-list" class="uk-offcanvas">
        <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
            <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="{multiple:true}">
                <li class="uk-nav-header">UIkit components</li>
                <li class="uk-parent uk-active">
                    <a href="#">Core</a>
                    <ul class="uk-nav-sub">
                        <?php foreach ( $_beans_uikit_enqueued_items['components']['core'] as $core ) : ?>
                            <li><a href="#"><?php echo $core; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="uk-parent uk-active">
                    <a href="#">Add-ons</a>
                    <ul class="uk-nav-sub">
                        <?php foreach ( $_beans_uikit_enqueued_items['components']['add-ons'] as $addons ) : ?>
                            <li><a href="#"><?php echo $addons; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <?php

}
