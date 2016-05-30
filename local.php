<?php
/* Template name: Local */

// Load necessary UIkit components.
add_action( 'beans_uikit_enqueue_scripts', 'start_view_enqueue_uikit_assets' );

function start_view_enqueue_uikit_assets() {

	beans_uikit_enqueue_components( array( 'flex', 'animation', 'contrast', 'overlay', 'thumbnail', 'modal', 'scrollspy', 'smooth-scroll', 'tab' ), 'core' );
	beans_uikit_enqueue_components( array( 'lightbox', 'slider', 'slideshow', 'accordion', 'slideshow-fx', 'sticky', 'tooltip', 'progress', 'modal', 'offcanvas' ), 'add-ons' );

}

// Force template layout

add_filter( 'beans_layout', 'beans_child_view_force_layout' );

function beans_child_view_force_layout() {

    return 'c';

}

// Remove comment div.
beans_remove_action( 'beans_comments_template' );

// Add Hero from registered post meta.
add_action( 'beans_header_after_markup', 'local_hero' );

function local_hero() {

    ?>
    <div class="tm-hero uk-cover uk-position-relative" itemscope itemtype="http://schema.org/LocalBusiness">
    <h2 itemprop="name">Medische Keuringen Noord</h2>
    <span itemprop="email">noord@medischekeuringen.net</span>
    <span itemprop="telephone">085-009-1562</span>
    <meta itemprop="logo" content="https://www.medischekeuringen.net/wp-content/uploads/medische-keuringen-logo" />
    <meta itemprop="url" content="https://www.medischekeuringen.net" />
    <span itemprop="description">Centraal gelegen in Zuid-Holland met uitmuntende bereikbaarheid voor industrieterreinen en uitvalswegen vindt U in Rotterdam Hoogvliet onze vestiging Medische Keuringen Noord. Bel 085-009-1562 voor meer informatie of Uw afspraak!</span>
    <meta itemprop="openingHours" content="Ma-Vr 07:00-21:00" />
    <meta itemprop="branchOf" content="Medische Keuringen" />
    <span itemprop="sameAs">https://goo.gl/maps/XNcAcpQ8zgC2</span>
    <span itemprop="sameAs">https://twitter.com/bedrijfskeuring</span>
    <span itemprop="sameAs">https://plus.google.com/+MedischekeuringenNetNoord</span>
    <span itemprop="sameAs">https://plus.google.com/+MedischeKeuringenNet</span>
    <span itemprop="sameAs">https://plus.google.com/+MedischekeuringenNetNoord</span>
    <span itemprop="sameAs">https://www.medischekeuringen.net/medische-keuring/rotterdam/</span>
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <span itemprop="streetAddress">Hoefsmidstraat 41</span>
            <span itemprop="postalCode">3194 AA</span>
            <span itemprop="addressLocality">Hoogvliet Rotterdam</span>
            <span itemprop="addressRegion">Zuid Holland</span>
        </div>
        <div itemscope itemtype="http://schema.org/GeoCoordinates">
            <span itemprop="latitude">51.87238</span>
            <span itemprop="longitude">4.37222</span>
        </div>
    </div>
    <?php

}

// Load document which is always needed at the bottom of template files.
beans_load_document();