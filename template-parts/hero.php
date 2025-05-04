<?php
/**
 * Template part for displaying the hero section
 *
 * @package Kitchenary
 */

?>

<section class="hero-image flex items-center justify-center text-white fade-in">
    <div class="text-center px-4 max-w-3xl">
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
</section> 