<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), false );
	
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

/*********** POST TYPE *********/

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'presse',
    array(
      'labels' => array(
        'name' => __( 'La Presse' ),
        'menu_name' => __('Presse'),
        'all_items' => 'Tous les articles de presse',
      'add_new_item' => 'Ajouter un article de presse',
      'edit_item' => 'Éditer l\'article de presse',
      'new_item' => 'Nouvel article de presse',
      'view_item' => 'Voir l\'article de presse',
      'search_items' => 'Rechercher parmi les articles de presse',
      'not_found' => 'Pas d\'article de presse trouvé',
      'not_found_in_trash'=> 'Pas d\'article de presse dans la corbeille'
      ),
      'public' => true,
      'supports'=>array('title','editor','thumbnail','excerpt','revisions','page-attributes','post-formats'),
      'query_var' => true,
      'rewrite' => true,
      'hierarchical' => true,
      'capability_type' => 'page',
    )
  );
  register_post_type( 'artiste',
    array(
      'labels' => array(
        'name' => __( 'Artistes' ),
        'menu_name' => __('Artistes'),
        'all_items' => 'Tous les artistes',
      'add_new_item' => 'Ajouter un artiste',
      'edit_item' => 'Éditer l\'artiste',
      'new_item' => 'Nouvel artiste',
      'view_item' => 'Voir l\'artiste',
      'search_items' => 'Rechercher parmi les artistes',
      'not_found' => 'Pas d\'artiste trouvé',
      'not_found_in_trash'=> 'Pas d\'artiste dans la corbeille'
      ),
      'public' => true,
      'supports'=>array('title','editor','thumbnail','excerpt','revisions','page-attributes','post-formats'),
      'query_var' => true,
      'rewrite' => true,
      'hierarchical' => true,
      'capability_type' => 'page',
    )
  );
  register_taxonomy('support','presse',array( 'hierarchical' => false, 'label' => 'Support', 'query_var' => true, 'rewrite' => array( 'slug' => 'support' ) ));
  register_taxonomy('artiste','presse',array( 'hierarchical' => false, 'label' => 'Artistes', 'query_var' => true, 'rewrite' => array( 'slug' => 'artiste' ) ));
  //register_taxonomy('reference','disque',array( 'hierarchical' => false, 'label' => 'Type de structures', 'query_var' => true, 'rewrite' => array( 'slug' => 'reference' ) ));
  //register_taxonomy('tagexpo','disque',array( 'hierarchical' => false, 'label' => 'Références clients', 'query_var' => true, 'rewrite' => array( 'slug' => 'tags' ) ));
  //register_taxonomy('category','reference',array( 'hierarchical' => false, 'label' => 'Catégories', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie' ) ));
  //register_taxonomy('tag','reference',array( 'hierarchical' => false, 'label' => 'Tags', 'query_var' => true, 'rewrite' => array( 'slug' => 'tags' ) ));
  //register_taxonomy('cat','archive',array( 'hierarchical' => false, 'label' => 'Catégories', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie' ) ));
  //register_taxonomy('cat','programme',array( 'hierarchical' => false, 'label' => 'Catégorie du programme', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie_programme' ) ));
}

/**
 * Add the OceanWP Settings metabox in your CPT
 */
function oceanwp_metabox( $types ) {

	// Your custom post type
	$types[] = 'artiste';

	// Return
	return $types;

}
add_filter( 'ocean_main_metaboxes_post_types', 'oceanwp_metabox', 20 );

/****** custom breadcrumbs ****/
             
add_filter( 'wpseo_breadcrumb_links', 'wpse_breadcrumb_disque' );

function wpse_breadcrumb_disque( $links ) {
    global $post;

//    if ( is_page() ) {
//        $breadcrumb[] = array(
//            //'url' => get_permalink( get_option( 'page_for_posts' ) ),
//            'url' => get_page_link(3),
//            'text' => get_the_title( 3 ),
//        );
//
//        array_splice( $links, 1, -2, $breadcrumb );
//    }
    if ( is_singular( 'presse' ) ) {
        $breadcrumb[] = array(
            //'url' => get_permalink( get_option( 'page_for_posts' ) ),
            'url' => get_page_link(2),
            'text' => get_the_title( 2 ),
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }
    if ( is_singular( 'presse' ) ) {
        $breadcrumb2[] = array(
            //'url' => get_permalink( get_option( 'page_for_posts' ) ),
            'url' => get_page_link(566),
            'text' => get_the_title( 566 ),
        );

        array_splice( $links, 1, -2, $breadcrumb2 );
    }
    if ( is_singular( 'artiste' ) ) {
        $breadcrumb[] = array(
            //'url' => get_permalink( get_option( 'page_for_posts' ) ),
            'url' => get_page_link(50),
            'text' => get_the_title( 50 ),
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }

    return $links;
}