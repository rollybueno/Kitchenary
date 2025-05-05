<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Kitchenary
 */

get_header();
?>

<main class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <!-- 404 Icon -->
            <div class="mb-8">
                <div class="bg-amber-100 w-24 h-24 mx-auto rounded-full flex items-center justify-center">
                    <i class="fas fa-utensils text-amber-700 text-4xl"></i>
                </div>
            </div>

            <!-- Error Message -->
            <h1 class="text-6xl font-bold text-amber-700 mb-4">404</h1>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Page Not Found</h2>
            <p class="text-gray-600 text-lg mb-8">Oops! The recipe you're looking for seems to have disappeared from our kitchen.</p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-full font-medium transition">
                    Back to Home
                </a>
                <a href="<?php echo esc_url(home_url('/recipes')); ?>" class="bg-white hover:bg-gray-100 text-amber-700 px-6 py-3 rounded-full font-medium transition border border-amber-600">
                    Browse Recipes
                </a>
            </div>

            <!-- Search Section -->
            <div class="mt-12 bg-white rounded-xl p-8 shadow-md">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Looking for something specific?</h3>
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="flex gap-2">
                        <input type="search" class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                               placeholder="Search recipes..." 
                               value="<?php echo get_search_query(); ?>" 
                               name="s" />
                        <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded-full hover:bg-amber-700 transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
get_footer(); 