<?php
/**
 * The template for displaying all single chalets.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php
/**
 * 
 * Déclaration des variables ACF
 * 
 */
$taille = get_field('taille');
$description = get_field('description');
$nb_piece = get_field('nombre_de_piece');
$prix = get_field('prix');
$img = get_field('_thumbnail_id');
$bg_img = get_field('image_de_fond'); 
$category = get_field('categorie');



 ?>
<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); 



        ?>
        
        <?php if($bg_img):?>
        <div class="hero-chalet" style="background-image: url('<?php echo $bg_img;?>'); ">

        </div>
        <?php endif ?>           

        <div class="titre-chalet" >
            <h1 class="titre-chalet"><?php echo get_the_title(); ?></h1>
        </div>

        <?php
        /***
         * solution par appel de template (achat/location) vide
         * puis remplissage par shortcode
         * 
         */
        $chalet = get_post($category->name =="achat"?1935:1952);
            //$category->name =="achat"? 1895: 1911);
           $content_post = $chalet;
           $content = $content_post->post_content;
           $content = apply_filters('the_content', $content);
           $content = str_replace(']]>', ']]&gt;', $content);
           echo $content;
           if ( have_posts() ) :
               while ( have_posts() ) : the_post();
                   the_content();
               endwhile;
           endif;
           ?>
        <?php astra_content_loop(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer();?>