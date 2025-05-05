<?php
/**
 * The template for displaying search results pages
 *
 * @package Kitchenary
 */

get_header();
?>

<main class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <?php if (have_posts()) : ?>
            <!-- Search Results Header -->
            <div class="max-w-4xl mx-auto mb-12">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    <?php
                    printf(
                        esc_html__('Search Results for: %s', 'kitchenary'),
                        '<span class="text-amber-600">' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
                <p class="text-gray-600">
                    <?php
                    printf(
                        esc_html(_n('Found %d result', 'Found %d results', $wp_query->found_posts, 'kitchenary')),
                        $wp_query->found_posts
                    );
                    ?>
                </p>
            </div>

            <!-- Search Results Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article class="recipe-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="overflow-hidden">
                                <?php the_post_thumbnail('medium_large', ['class' => 'recipe-image w-full h-64 object-cover']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <?php
                                $categories = get_the_category();
                                if ($categories) :
                                    $category = $categories[0];
                                    ?>
                                    <span class="bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        <?php echo esc_html($category->name); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h2 class="text-xl font-bold mb-2">
                                <a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-amber-600 transition">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <p class="text-gray-600 mb-4">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span><i class="far fa-clock mr-1"></i> <?php echo get_the_date(); ?></span>
                                <a href="<?php the_permalink(); ?>" class="text-amber-600 hover:text-amber-700">
                                    Read More <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                    'class'     => 'flex space-x-2',
                    'before_page_number' => '<span class="bg-amber-100 text-amber-800 hover:bg-amber-200 px-4 py-2 rounded-full transition">',
                    'after_page_number'  => '</span>',
                    'link_before'        => '<span class="bg-amber-100 text-amber-800 hover:bg-amber-200 px-4 py-2 rounded-full transition">',
                    'link_after'         => '</span>',
                    'prev_link'          => '<span class="bg-amber-100 text-amber-800 hover:bg-amber-200 px-4 py-2 rounded-full transition">',
                    'next_link'          => '<span class="bg-amber-100 text-amber-800 hover:bg-amber-200 px-4 py-2 rounded-full transition">',
                ));
                ?>
            </div>

        <?php else : ?>
            <!-- No Results Found -->
            <div class="max-w-2xl mx-auto text-center">
                <!-- Search Icon -->
                <div class="mb-8">
                    <div class="bg-amber-100 w-24 h-24 mx-auto rounded-full flex items-center justify-center">
                        <i class="fas fa-search text-amber-700 text-4xl"></i>
                    </div>
                </div>

                <!-- No Results Message -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4">No Recipes Found</h1>
                <p class="text-gray-600 text-lg mb-8">
                    <?php
                    printf(
                        esc_html__('We couldn\'t find any recipes matching "%s". Try different keywords or browse our categories.', 'kitchenary'),
                        '<span class="text-amber-600">' . get_search_query() . '</span>'
                    );
                    ?>
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-full font-medium transition">
                        Back to Home
                    </a>
                    <a href="<?php echo esc_url(home_url('/recipes')); ?>" class="bg-white hover:bg-gray-100 text-amber-700 px-6 py-3 rounded-full font-medium transition border border-amber-600">
                        Browse All Recipes
                    </a>
                </div>

                <!-- Search Section -->
                <div class="mt-12 bg-white rounded-xl p-8 shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Try Another Search</h3>
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="flex gap-2">
                            <input type="search" 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                                   placeholder="Search recipes..." 
                                   value="<?php echo get_search_query(); ?>" 
                                   name="s" />
                            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded-full hover:bg-amber-700 transition">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Popular Categories -->
                <div class="mt-12">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Popular Categories</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'count',
                            'order'   => 'DESC',
                            'number'  => 4,
                        ));

                        foreach ($categories as $category) :
                            ?>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                               class="bg-amber-50 rounded-xl p-4 text-center transition hover:bg-amber-100">
                                <div class="bg-amber-100 w-12 h-12 mx-auto rounded-full flex items-center justify-center mb-2">
                                    <i class="fas fa-utensils text-amber-700"></i>
                                </div>
                                <h4 class="font-semibold"><?php echo esc_html($category->name); ?></h4>
                                <p class="text-gray-600 text-sm"><?php echo esc_html($category->count); ?> recipes</p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer(); 