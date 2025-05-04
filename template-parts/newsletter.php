<?php
/**
 * Template part for displaying newsletter section.
 *
 * @package Kitchenary
 */

?>
<section class="py-16 bg-gray-800 text-white fade-in">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <i class="fas fa-paper-plane text-4xl text-amber-400 mb-4"></i>
            <h2 class="text-3xl font-bold mb-4"><?php esc_html_e( 'Join Our Foodie Community', 'kitchenary' ); ?></h2>
            <p class="text-gray-300 mb-8"><?php esc_html_e( 'Subscribe to our newsletter and get weekly recipes, cooking tips, and exclusive content straight to your inbox.', 'kitchenary' ); ?></p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
                <input type="email" placeholder="<?php esc_attr_e( 'Your email address', 'kitchenary' ); ?>" class="flex-grow px-4 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-full font-medium transition whitespace-nowrap">
                    <?php esc_html_e( 'Subscribe Now', 'kitchenary' ); ?>
                </button>
            </form>
            
            <p class="text-gray-400 text-xs mt-4"><?php esc_html_e( 'We respect your privacy. Unsubscribe at any time.', 'kitchenary' ); ?></p>
        </div>
    </div>
</section> 