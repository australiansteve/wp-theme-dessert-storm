<?php
/* Shortcode file */

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');


function austeve_jetpack_portfolio($atts, $content) {

    $atts = shortcode_atts( array(
        'include_type' => '',
        'include_tag' => '',
        'showposts' => -1,
    ), $atts );
    
    extract( $atts );

    ob_start();

    $args = array(
        'post_type' => 'jetpack-portfolio',
        'post_status' => array('publish'),
        'posts_per_page' => $showposts,
        'paged'         => false,

    );

    if ($include_type != '')
    {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'jetpack-portfolio-type',
                'field'    => 'slug',
                'terms'    => explode(',', $include_type),
            ),
        );
    }

    if ($include_tag != '')
    {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'jetpack-portfolio-type',
                'field'    => 'slug',
                'terms'    => explode(',', $include_type),
            ),
        );
    }

    $query = new WP_Query( $args );
    
    if( $query->have_posts() ){

?>    
    <div class="row small-up-1 medium-up-2 large-up-3">
<?php

        //loop over query results
        while( $query->have_posts() ){
            $query->the_post();
            
            include( plugin_dir_path( __FILE__ ) . 'page-templates/partials/jetpack-portfolio-archive.php');
        }

?>
    </div>
<?php
    }
    else {
?>
        <div class="row archive-container">
            <div class="col-xs-12">
                <em>No upcoming events found.</em>
            </div>
        </div>
<?php   
    }
    
    wp_reset_postdata();
    return ob_get_clean();

}

add_shortcode( 'austeve_projects', 'austeve_jetpack_portfolio' );

?>