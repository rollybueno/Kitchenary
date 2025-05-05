<?php
/**
 * The template for displaying author archive pages
 *
 * @package Kitchenary
 */

get_header();
?>

<main class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="<?php echo is_active_sidebar('blog-sidebar') ? 'lg:w-2/3' : 'lg:w-full max-w-4xl mx-auto'; ?>">
                <!-- Author Header -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="p-8">
                        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                            <div class="w-32 h-32 rounded-full overflow-hidden bg-amber-100 flex items-center justify-center">
                                <?php echo get_avatar(get_the_author_meta('ID'), 128, '', '', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                            <div class="text-center md:text-left">
                                <h1 class="text-3xl font-bold text-gray-800 mb-2"><?php the_author(); ?></h1>
                                <?php if (get_the_author_meta('description')) : ?>
                                    <p class="text-gray-600 mb-4"><?php the_author_meta('description'); ?></p>
                                <?php endif; ?>
                                <div class="flex flex-wrap justify-center md:justify-start gap-4 text-sm text-gray-600">
                                    <?php if (get_the_author_meta('user_url')) : ?>
                                        <a href="<?php echo esc_url(get_the_author_meta('user_url')); ?>" 
                                           class="flex items-center hover:text-amber-500 transition">
                                            <i class="fas fa-globe mr-2"></i>
                                            <?php echo esc_url(get_the_author_meta('user_url')); ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (get_the_author_meta('twitter')) : ?>
                                        <a href="<?php echo esc_url(get_the_author_meta('twitter')); ?>" 
                                           class="flex items-center hover:text-amber-500 transition">
                                            <i class="fab fa-twitter mr-2"></i>
                                            <?php echo esc_html(get_the_author_meta('twitter')); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Author Posts -->
                <?php if (have_posts()) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <?php while (have_posts()) : the_post(); ?>
                            <article class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="overflow-hidden">
                                        <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-48 object-cover']); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="p-6">
                                    <!-- Post Meta -->
                                    <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                                        <span class="flex items-center">
                                            <i class="far fa-clock mr-2"></i>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        <?php if (get_comments_number() > 0) : ?>
                                            <span class="flex items-center">
                                                <i class="far fa-comment mr-2"></i>
                                                <?php comments_number('No comments', '1 comment', '% comments'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Post Title -->
                                    <h2 class="text-xl font-bold mb-3">
                                        <a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-amber-600 transition">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <!-- Post Excerpt -->
                                    <p class="text-gray-600 mb-4">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                    </p>

                                    <!-- Read More Link -->
                                    <a href="<?php the_permalink(); ?>" class="text-amber-600 hover:text-amber-700 text-sm font-medium">
                                        Read More <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-chevron-left"></i> Previous',
                            'next_text' => 'Next <i class="fas fa-chevron-right"></i>',
                            'class'     => 'flex justify-center gap-2',
                            'before_page_number' => '<span class="px-4 py-2 bg-white rounded-lg shadow-sm hover:bg-amber-50 transition">',
                            'after_page_number'  => '</span>',
                        ));
                        ?>
                    </div>

                <?php else : ?>
                    <div class="bg-white rounded-xl shadow-md p-8 text-center">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">No Posts Found</h2>
                        <p class="text-gray-600">This author hasn't published any posts yet.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <?php if (is_active_sidebar('blog-sidebar')) : ?>
                <div class="lg:w-1/3">
                    <div class="sticky top-8">
                        <?php dynamic_sidebar('blog-sidebar'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer(); 