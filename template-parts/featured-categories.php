<?php
/**
 * Template part for displaying featured categories
 *
 * @package Kitchenary
 */

// Get recipe categories
$categories = get_categories( array(
	'taxonomy'   => 'recipe_category',
	'hide_empty' => true,
	'number'     => 4, // Limit to 4 categories
) );

if ( ! empty( $categories ) ) : ?>
	<section class="py-12 bg-white fade-in">
		<div class="container mx-auto px-4">
			<h2 class="text-3xl font-bold text-center mb-12"><?php esc_html_e( 'Recipe Categories', 'kitchenary' ); ?></h2>
			<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
				<?php foreach ( $categories as $category ) : ?>
					<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="group">
						<div class="bg-amber-50 rounded-xl p-6 text-center transition hover:bg-amber-100 h-full">
							<div class="bg-amber-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 group-hover:bg-amber-200 transition">
								<?php
								// Get category icon based on category name
								$icon = 'fa-utensils'; // Default icon
								switch ( strtolower( $category->name ) ) {
									case 'baking':
										$icon = 'fa-bread-slice';
										break;
									case 'vegetarian':
										$icon = 'fa-leaf';
										break;
									case 'desserts':
										$icon = 'fa-ice-cream';
										break;
									case 'main dishes':
										$icon = 'fa-drumstick-bite';
										break;
								}
								?>
								<i class="fas <?php echo esc_attr( $icon ); ?> text-amber-700 text-2xl"></i>
							</div>
							<h3 class="font-semibold text-lg"><?php echo esc_html( $category->name ); ?></h3>
							<p class="text-gray-600 text-sm mt-1">
								<?php
								printf(
									/* translators: %d: Number of recipes */
									esc_html( _n( '%d Recipe', '%d Recipes', $category->count, 'kitchenary' ) ),
									number_format_i18n( $category->count )
								);
								?>
							</p>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?> 