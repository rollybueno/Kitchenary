<?php
/**
 * Template part for displaying the hero section
 *
 * @package Kitchenary
 */

?>

<section class="hero-section relative min-h-[60vh] overflow-hidden fade-in">
	<div class="absolute inset-0">
		<img 
			src="<?php echo esc_url( get_theme_file_uri( 'assets/images/hero-image.jpg' ) ); ?>" 
			alt="<?php esc_attr_e( 'Delicious food spread', 'kitchenary' ); ?>"
			class="w-full h-full object-cover"
			loading="eager"
			fetchpriority="high"
		/>
		<div class="absolute inset-0 bg-black bg-opacity-30"></div>
	</div>
	<div class="relative z-10 min-h-[60vh] flex items-center justify-center">
		<div class="text-center px-4 max-w-3xl text-white">
			<h2 class="text-4xl md:text-5xl font-bold mb-4"><?php esc_html_e( 'Discover Delicious Recipes', 'kitchenary' ); ?></h2>
			<p class="text-xl mb-8"><?php esc_html_e( 'Handcrafted meals for every occasion, skill level, and dietary preference', 'kitchenary' ); ?></p>
			<div class="flex flex-col sm:flex-row justify-center gap-4">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'recipe' ) ); ?>" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-full font-medium transition">
					<?php esc_html_e( 'Explore Recipes', 'kitchenary' ); ?>
				</a>
				<a href="#" class="bg-white hover:bg-gray-100 text-amber-700 px-6 py-3 rounded-full font-medium transition">
					<?php esc_html_e( 'Weekly Meal Plan', 'kitchenary' ); ?>
				</a>
			</div>
		</div>
	</div>
</section> 
