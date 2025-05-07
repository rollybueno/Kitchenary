<?php
/**
 * The main template file
 *
 * @package Kitchenary
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container mx-auto px-4">
				<div class="<?php echo is_active_sidebar('blog-sidebar') ? 'lg:w-2/3' : 'lg:w-full max-w-4xl mx-auto'; ?>">
					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) :
							?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
							<?php
						endif;

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div><!-- .content-area -->

				<?php if (is_active_sidebar('blog-sidebar')) : ?>
					<div class="lg:w-1/3">
						<div class="sticky top-8">
							<?php dynamic_sidebar('blog-sidebar'); ?>
						</div>
					</div>
				<?php endif; ?>
		</div><!-- .container -->
	</main><!-- #primary -->

<?php
get_footer(); 