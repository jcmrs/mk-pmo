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

/*
 * Customisations start here.
 */

// Add Smooth Scroll.
add_action( 'beans_uikit_enqueue_scripts', 'smooth_scroll_enqueue_uikit_assets' );

function smooth_scroll_enqueue_uikit_assets() {

    beans_uikit_enqueue_components( array( 'smooth-scroll' ) );
    beans_compiler_add_fragment( 'uikit', get_stylesheet_directory() . '/style.less', 'less' );

}

// Add Back to Top. Figure out why it doesn't scroll back all the way to the top!
beans_add_attribute( 'beans_body', 'id', 'mk-top' );
// beans_add_attribute( 'tm_header_bar', 'id', 'mk-top' );

// Add sticky component to uikit for sticky Navbar
beans_uikit_enqueue_components( array( 'sticky' ), 'add-ons' );

// Sticky menu
// Issue: not working as intended. UI glitching.
beans_add_attribute( 'beans_header', 'data-uk-sticky', '{ animation: \'uk-animation-slide-top\', showup:true }' );

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
