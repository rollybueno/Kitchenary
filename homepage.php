<?php
/**
 * The template for displaying the homepage
 *
 * @package Kitchenary
 */

 get_header();
 ?>
 
     <main id="primary" class="site-main">
         <?php if ( is_home() || is_front_page() ) : ?>
             <?php get_template_part( 'template-parts/hero' ); ?>
             <?php get_template_part( 'template-parts/featured-categories' ); ?>
             <?php get_template_part( 'template-parts/latest-recipes' ); ?>
             <?php get_template_part( 'template-parts/featured-recipe' ); ?>
             <?php get_template_part( 'template-parts/newsletter' ); ?>
             <?php get_template_part( 'template-parts/latest-posts' ); ?>
         <?php endif; ?>
     </main>

<?php
get_sidebar();
get_footer();
