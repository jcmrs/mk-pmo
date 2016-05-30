<?php
/* Template name: Test */

// Load necessary UIkit components.
add_action( 'beans_uikit_enqueue_scripts', 'start_view_enqueue_uikit_assets' );

function start_view_enqueue_uikit_assets() {

	beans_uikit_enqueue_components( array( 'flex', 'animation', 'icon', 'list', 'contrast', 'overlay', 'thumbnail', 'modal', 'scrollspy', 'smooth-scroll', 'tab' ), 'core' );
	beans_uikit_enqueue_components( array( 'lightbox', 'slider', 'slideshow', 'accordion', 'slideshow-fx', 'sticky', 'tooltip', 'progress', 'modal', 'offcanvas' ), 'add-ons' );

}

// Force template layout

add_filter( 'beans_layout', 'beans_child_view_force_layout' );

function beans_child_view_force_layout() {

    return 'c';

}

// Alternate Replace default Footer Content.
// Issue: not applying tm-main to footer itself. Apply to beans_footer instead of footer_content yes/no
beans_modify_action_callback( 'beans_footer_content', 'start_child_footer_content' );
function start_child_footer_content() {

    ?>
    <div class="uk-grid uk-container-center uk-text-small" data-uk-grid-margin>

        <div class="uk-width-medium-1-2">
            <div class="uk-panel uk-panel-box uk-panel-box-secondary" itemscope itemtype="http://schema.org/LocalBusiness">
                <h3 class="uk-panel-title" itemprop="name">Company Name</h3>
                
                <span itemprop="description">Centraal gelegen in Zuid-Holland met uitmuntende bereikbaarheid voor industrieterreinen en uitvalswegen vindt U in Rotterdam Hoogvliet onze vestiging Medische Keuringen Noord. Bel 085-009-1562 voor meer informatie of Uw afspraak!</span>

                
                <h3 class="uk-h4">Address</h3>
                
                <ul class="uk-list uk-list-space" itemtype="http://schema.org/PostalAddress" itemscope="" itemprop="address">
                    <li itemprop="streetAddress">Street</li>
                    <li itemprop="postalCode">0000AA</li>
                    <li itemprop="addressRegion">Region</li>
                    <li itemprop="addressLocality">City</li>
                    <li itemprop="addressCountry">NL</li>
                </ul>
                
                <h3 class="uk-h4">Direct contact</h3>
                
                <ul class="uk-list uk-list-space">
                    <li itemprop="email"><a href='mailto:info@medischekeuringen.net'>info@mail.com</a></li>
                    <li itemprop="telephone"><a href='tel:+31-00-000-0000'>000-000-0000</a></li>
                    <li itemprop="url"><a href='https://mk-pmo-jcmrs.c9users.io'>https://mk-pmo-jcmrs.c9users.io</a></li>
                    <li itemprop="potentialAction"><a href='https://www.medischekeuringen.net/contact/'>Make appointment</a></li>
                    <li itemprop="hasMap"><a href='https://goo.gl/maps/MUT3NRfYcV52'>Plot Route</a></li>
                </ul>
                
                <h3 class="uk-h4">Business hours</h3>
                
                <ul class="uk-list uk-list-space">
                    <meta itemprop="openingHours"  style='display: none'  datetime="Mo,Tu,We,Th,Fr,Sa 07:00-21:00" />
                    <li itemprop="openingHours">Mo-Fr 07:00-21:00</li>
                </ul>
                
                <h3 class="uk-h4">Payment options</h3>
                
                <ul class="uk-list uk-list-space">
                    <div itemprop="paymentAccepted"  style='display: none' >cash, invoice</div>
                   <li>Cash</li>
                   <li>invoice</li>
                </ul>
                
                <p>
                    <a itemprop="sameAs "href="#" class="uk-icon-button uk-icon-cog"></a>
                    <a itemprop="sameAs" href="#" class="uk-icon-button uk-icon-cog"></a>
                    <a itemprop="sameAs" href="#" class="uk-icon-button uk-icon-cog"></a>
                    <a itemprop="sameAs" href="#" class="uk-icon-button uk-icon-cog"></a>
                </p>
                
                <div itemtype="http://schema.org/GeoCoordinates" itemscope="" itemprop="geo">
            		<meta itemprop="latitude" content="51.87238" />
            		<meta itemprop="longitude" content="4.37222" />
            	</div>
                
            </div>
        </div>

        <div class="uk-width-medium-1-2">
            <div class="uk-grid">
                <div>Company name</div>
                <div>Description</div>
                <div>Lefthand Address</div>
                <div>Righthand Contacts</div>
                <div>Lefthand Opening Hours</div>
                <div>Righthand Payment options</div>
                <div>Lefthand Plot Route</div>
                <div>Righthand Social</div>
            </div>
        </div>
    </div>
    <?php
}

// Load document which is always needed at the bottom of template files.
beans_load_document();