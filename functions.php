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

}

// Remove this action and callback function if you are not adding CSS in the style.css file.
add_action( 'wp_enqueue_scripts', 'beans_child_enqueue_assets' );

function beans_child_enqueue_assets() {

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );

}

/*
 * Customisations start here.
 */



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
