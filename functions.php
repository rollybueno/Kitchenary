<?php
/**
 * Kitchenary functions and definitions
 *
 * @package Kitchenary
 */

if ( ! defined( 'KITCHENARY_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'KITCHENARY_VERSION', '1.0.0' );
}

/**
 * Register recipe post type.
 */
function kitchenary_register_recipe_post_type() {
	$labels = array(
		'name'                  => _x( 'Recipes', 'Post type general name', 'kitchenary' ),
		'singular_name'         => _x( 'Recipe', 'Post type singular name', 'kitchenary' ),
		'menu_name'             => _x( 'Recipes', 'Admin Menu text', 'kitchenary' ),
		'name_admin_bar'        => _x( 'Recipe', 'Add New on Toolbar', 'kitchenary' ),
		'add_new'               => __( 'Add New', 'kitchenary' ),
		'add_new_item'          => __( 'Add New Recipe', 'kitchenary' ),
		'new_item'              => __( 'New Recipe', 'kitchenary' ),
		'edit_item'             => __( 'Edit Recipe', 'kitchenary' ),
		'view_item'             => __( 'View Recipe', 'kitchenary' ),
		'all_items'             => __( 'All Recipes', 'kitchenary' ),
		'search_items'          => __( 'Search Recipes', 'kitchenary' ),
		'parent_item_colon'     => __( 'Parent Recipes:', 'kitchenary' ),
		'not_found'             => __( 'No recipes found.', 'kitchenary' ),
		'not_found_in_trash'    => __( 'No recipes found in Trash.', 'kitchenary' ),
		'featured_image'        => _x( 'Recipe Cover Image', 'Overrides the "Featured Image" phrase for this post type.', 'kitchenary' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase for this post type.', 'kitchenary' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase for this post type.', 'kitchenary' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase for this post type.', 'kitchenary' ),
		'archives'              => _x( 'Recipe archives', 'The post type archive label used in nav menus.', 'kitchenary' ),
		'insert_into_item'      => _x( 'Insert into recipe', 'Overrides the "Insert into post" phrase for this post type.', 'kitchenary' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this recipe', 'Overrides the "Uploaded to this post" phrase for this post type.', 'kitchenary' ),
		'filter_items_list'     => _x( 'Filter recipes list', 'Screen reader text for the filter links heading on the post type listing screen.', 'kitchenary' ),
		'items_list_navigation' => _x( 'Recipes list navigation', 'Screen reader text for the pagination heading on the post type listing screen.', 'kitchenary' ),
		'items_list'            => _x( 'Recipes list', 'Screen reader text for the items list heading on the post type listing screen.', 'kitchenary' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'recipe' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-food',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'recipe', $args );
}
add_action( 'init', 'kitchenary_register_recipe_post_type' );

/**
 * Register recipe_category taxonomy.
 */
function kitchenary_register_recipe_taxonomy() {
	$labels = array(
		'name'              => _x( 'Recipe Categories', 'taxonomy general name', 'kitchenary' ),
		'singular_name'     => _x( 'Recipe Category', 'taxonomy singular name', 'kitchenary' ),
		'search_items'      => __( 'Search Recipe Categories', 'kitchenary' ),
		'all_items'         => __( 'All Recipe Categories', 'kitchenary' ),
		'parent_item'       => __( 'Parent Recipe Category', 'kitchenary' ),
		'parent_item_colon' => __( 'Parent Recipe Category:', 'kitchenary' ),
		'edit_item'         => __( 'Edit Recipe Category', 'kitchenary' ),
		'update_item'       => __( 'Update Recipe Category', 'kitchenary' ),
		'add_new_item'      => __( 'Add New Recipe Category', 'kitchenary' ),
		'new_item_name'     => __( 'New Recipe Category Name', 'kitchenary' ),
		'menu_name'         => __( 'Recipe Categories', 'kitchenary' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'recipe-category' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'recipe_category', array( 'recipe' ), $args );
}
add_action( 'init', 'kitchenary_register_recipe_taxonomy' );

/**
 * Create default recipe categories on theme activation.
 */
function kitchenary_create_default_categories() {
	$default_categories = array(
		'baking'      => array(
			'name'        => __( 'Baking', 'kitchenary' ),
			'description' => __( 'Delicious baked goods and desserts.', 'kitchenary' ),
		),
		'vegetarian'  => array(
			'name'        => __( 'Vegetarian', 'kitchenary' ),
			'description' => __( 'Plant-based recipes for vegetarians.', 'kitchenary' ),
		),
		'desserts'    => array(
			'name'        => __( 'Desserts', 'kitchenary' ),
			'description' => __( 'Sweet treats and desserts.', 'kitchenary' ),
		),
		'main-dishes' => array(
			'name'        => __( 'Main Dishes', 'kitchenary' ),
			'description' => __( 'Main course recipes and entrees.', 'kitchenary' ),
		),
	);

	foreach ( $default_categories as $slug => $category ) {
		if ( ! term_exists( $slug, 'recipe_category' ) ) {
			wp_insert_term(
				$category['name'],
				'recipe_category',
				array(
					'description' => $category['description'],
					'slug'        => $slug,
				)
			);
		}
	}
}
add_action( 'after_switch_theme', 'kitchenary_create_default_categories' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function kitchenary_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Add custom image sizes
	add_image_size( 'kitchenary-card', 600, 400, true ); // For blog cards and recipe cards
	add_image_size( 'kitchenary-featured', 1200, 600, true ); // For featured images and full-width
	add_image_size( 'kitchenary-hero', 1920, 800, true ); // For hero sections

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary'           => esc_html__( 'Primary Menu', 'kitchenary' ),
			'footer-left-menu'  => esc_html__( 'Footer Left Menu', 'kitchenary' ),
			'footer-right-menu' => esc_html__( 'Footer Right Menu', 'kitchenary' ),
			'footer-links'      => __( 'Footer Links', 'kitchenary' ),
		)
	);

	// Switch default core markup to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'kitchenary_setup' );

/**
 * Custom navigation walker class for the theme.
 */
class Kitchenary_Walker_Nav_Menu extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );

		// Position classes based on depth
		$position_classes = '';
		$rounded_classes  = '';

		if ( $depth === 0 ) {
			$position_classes = 'left-0 mt-2';
			$rounded_classes  = 'rounded-md';
		} elseif ( $depth === 1 ) {
			$position_classes = 'left-full top-0';
			$rounded_classes  = 'rounded-md';
		} elseif ( $depth === 2 ) {
			$position_classes = 'left-full top-0';
			$rounded_classes  = 'rounded-r-md'; // Only round the right corners
		}

		$output .= "\n$indent<ul class=\"absolute {$position_classes} {$rounded_classes} w-48 bg-white shadow-lg py-1 z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out\">\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Add Tailwind CSS classes based on depth
		if ( $depth === 0 ) {
			$classes[] = 'relative group';
		} elseif ( $depth === 1 ) {
			$classes[] = 'relative group';
		} elseif ( $depth === 2 ) {
			$classes[] = 'relative group';
		}

		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		// Add Tailwind CSS classes to the link based on depth
		if ( $depth === 0 ) {
			$atts['class'] = 'block px-4 py-2 text-gray-600 hover:text-amber-500 transition';
		} elseif ( $depth === 1 ) {
			$atts['class'] = 'block px-4 py-2 text-gray-600 hover:text-amber-500 hover:bg-gray-50 transition flex justify-between items-center';
			// Add arrow for items with children
			if ( in_array( 'menu-item-has-children', $classes ) ) {
				$atts['class'] .= ' after:content-[\'›\'] after:ml-2 after:text-gray-400';
			}
		} else {
			$atts['class'] = 'block px-4 py-2 text-gray-600 hover:text-amber-500 hover:bg-gray-50 transition';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Enqueue scripts and styles.
 */
function kitchenary_scripts() {
	// Enqueue main stylesheet
	wp_enqueue_style( 'kitchenary-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	// Enqueue Tailwind CSS
	wp_enqueue_style( 'kitchenary-tailwind', get_template_directory_uri() . '/assets/css/main.css', array(), wp_get_theme()->get( 'Version' ) );

	// Enqueue Font Awesome
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0' );

	// Enqueue Swiper CSS
	wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );

	// Enqueue Swiper JS
	wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );

	// Enqueue custom JS
	wp_enqueue_script( 'kitchenary-scripts', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kitchenary_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kitchenary_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Add Tailwind CSS classes.
	$classes[] = 'font-sans';
	$classes[] = 'bg-gray-50';
	$classes[] = 'text-gray-800';

	return $classes;
}
add_filter( 'body_class', 'kitchenary_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kitchenary_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'kitchenary_pingback_header' );

/**
 * Display the post thumbnail.
 */
function kitchenary_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
			?>
		</a>

		<?php
	endif; // End is_singular().
}

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function kitchenary_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'kitchenary' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the current author.
 */
function kitchenary_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'kitchenary' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function kitchenary_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'kitchenary' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'kitchenary' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'kitchenary' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'kitchenary' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'kitchenary' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'kitchenary' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Register widget areas.
 */
function kitchenary_widgets_init() {
	// Recipe Sidebar (for single-recipe.php)
	register_sidebar(
		array(
			'name'          => esc_html__( 'Recipe Sidebar', 'kitchenary' ),
			'id'            => 'recipe-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in recipe sidebar.', 'kitchenary' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s bg-white rounded-xl shadow-md overflow-hidden mb-6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="text-xl font-bold text-white bg-amber-500 px-6 py-4">',
			'after_title'   => '</h3><div class="p-6 widget-content"><style>.widget-content a { @apply text-gray-600 hover:text-amber-500 transition-colors duration-200; } .widget-content ul { @apply space-y-2; } .widget-content li { @apply border-b border-gray-100 last:border-0 pb-2 last:pb-0; }</style>',
		)
	);

	// Blog Sidebar (for single.php)
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'kitchenary' ),
			'id'            => 'blog-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in blog post sidebar.', 'kitchenary' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s bg-white rounded-xl shadow-md overflow-hidden mb-6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="text-xl font-bold text-white bg-amber-500 px-6 py-4">',
			'after_title'   => '</h3><div class="p-6 widget-content"><style>.widget-content a { @apply text-gray-600 hover:text-amber-500 transition-colors duration-200; } .widget-content ul { @apply space-y-2; } .widget-content li { @apply border-b border-gray-100 last:border-0 pb-2 last:pb-0; }</style>',
		)
	);
}
add_action( 'widgets_init', 'kitchenary_widgets_init' );

/**
 * Register recipe review post type.
 */
function kitchenary_register_recipe_review_post_type() {
	$labels = array(
		'name'               => _x( 'Recipe Reviews', 'Post type general name', 'kitchenary' ),
		'singular_name'      => _x( 'Recipe Review', 'Post type singular name', 'kitchenary' ),
		'menu_name'          => _x( 'Recipe Reviews', 'Admin Menu text', 'kitchenary' ),
		'name_admin_bar'     => _x( 'Recipe Review', 'Add New on Toolbar', 'kitchenary' ),
		'add_new'            => __( 'Add New', 'kitchenary' ),
		'add_new_item'       => __( 'Add New Review', 'kitchenary' ),
		'new_item'           => __( 'New Review', 'kitchenary' ),
		'edit_item'          => __( 'Edit Review', 'kitchenary' ),
		'view_item'          => __( 'View Review', 'kitchenary' ),
		'all_items'          => __( 'All Reviews', 'kitchenary' ),
		'search_items'       => __( 'Search Reviews', 'kitchenary' ),
		'not_found'          => __( 'No reviews found.', 'kitchenary' ),
		'not_found_in_trash' => __( 'No reviews found in Trash.', 'kitchenary' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=recipe',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'recipe-review' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'recipe_review', $args );
}
add_action( 'init', 'kitchenary_register_recipe_review_post_type' );

/**
 * Add meta boxes for recipe review.
 */
function kitchenary_add_recipe_review_meta_boxes() {
	add_meta_box(
		'recipe_review_details',
		__( 'Review Details', 'kitchenary' ),
		'kitchenary_recipe_review_meta_box_callback',
		'recipe_review',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'kitchenary_add_recipe_review_meta_boxes' );

/**
 * Recipe review meta box callback.
 */
function kitchenary_recipe_review_meta_box_callback( $post ) {
	wp_nonce_field( 'recipe_review_meta_box', 'recipe_review_meta_box_nonce' );

	$rating        = get_post_meta( $post->ID, '_recipe_review_rating', true );
	$recipe_id     = get_post_meta( $post->ID, '_recipe_review_recipe_id', true );
	$helpful_votes = get_post_meta( $post->ID, '_recipe_review_helpful_votes', true );
	$helpful_votes = $helpful_votes ? $helpful_votes : 0;

	?>
	<div class="recipe-review-meta">
		<p>
			<label for="recipe_review_rating"><?php esc_html_e( 'Rating (1-5):', 'kitchenary' ); ?></label>
			<select name="recipe_review_rating" id="recipe_review_rating" required>
				<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
					<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $rating, $i ); ?>>
						<?php echo esc_html( $i ); ?> <?php echo $i === 1 ? esc_html__( 'Star', 'kitchenary' ) : esc_html__( 'Stars', 'kitchenary' ); ?>
					</option>
				<?php endfor; ?>
			</select>
		</p>

		<p>
			<label for="recipe_review_recipe_id"><?php esc_html_e( 'Recipe:', 'kitchenary' ); ?></label>
			<select name="recipe_review_recipe_id" id="recipe_review_recipe_id" required>
				<option value=""><?php esc_html_e( 'Select a recipe', 'kitchenary' ); ?></option>
				<?php
				$recipes = get_posts(
					array(
						'post_type'      => 'recipe',
						'posts_per_page' => -1,
						'orderby'        => 'title',
						'order'          => 'ASC',
					)
				);

				foreach ( $recipes as $recipe ) :
					?>
					<option value="<?php echo esc_attr( $recipe->ID ); ?>" <?php selected( $recipe_id, $recipe->ID ); ?>>
						<?php echo esc_html( $recipe->post_title ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label><?php esc_html_e( 'Helpful Votes:', 'kitchenary' ); ?></label>
			<span><?php echo esc_html( $helpful_votes ); ?></span>
		</p>
	</div>
	<?php
}

/**
 * Save recipe review meta box data.
 */
function kitchenary_save_recipe_review_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['recipe_review_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['recipe_review_meta_box_nonce'], 'recipe_review_meta_box' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['recipe_review_rating'] ) ) {
		update_post_meta( $post_id, '_recipe_review_rating', sanitize_text_field( $_POST['recipe_review_rating'] ) );
	}

	if ( isset( $_POST['recipe_review_recipe_id'] ) ) {
		update_post_meta( $post_id, '_recipe_review_recipe_id', sanitize_text_field( $_POST['recipe_review_recipe_id'] ) );
	}
}
add_action( 'save_post_recipe_review', 'kitchenary_save_recipe_review_meta_box_data' );

/**
 * Update recipe rating when a review is added or updated.
 */
function kitchenary_update_recipe_rating( $post_id ) {
	$recipe_id = get_post_meta( $post_id, '_recipe_review_recipe_id', true );
	if ( ! $recipe_id ) {
		return;
	}

	$reviews = get_posts(
		array(
			'post_type'      => 'recipe_review',
			'posts_per_page' => -1,
			'meta_key'       => '_recipe_review_recipe_id',
			'meta_value'     => $recipe_id,
		)
	);

	$total_rating = 0;
	$review_count = count( $reviews );

	foreach ( $reviews as $review ) {
		$rating        = get_post_meta( $review->ID, '_recipe_review_rating', true );
		$total_rating += intval( $rating );
	}

	$average_rating = $review_count > 0 ? round( $total_rating / $review_count, 1 ) : 0;

	update_post_meta( $recipe_id, 'recipe_rating', $average_rating );
	update_post_meta( $recipe_id, 'recipe_reviews', $review_count );
}
add_action( 'save_post_recipe_review', 'kitchenary_update_recipe_rating' );

/**
 * Handle recipe review submission.
 */
function kitchenary_handle_recipe_review_submission() {
	check_ajax_referer( 'submit_recipe_review', 'recipe_review_nonce' );

	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'message' => __( 'You must be logged in to submit a review.', 'kitchenary' ) ) );
	}

	$recipe_id = isset( $_POST['recipe_id'] ) ? intval( $_POST['recipe_id'] ) : 0;
	$title     = isset( $_POST['review_title'] ) ? sanitize_text_field( $_POST['review_title'] ) : '';
	$rating    = isset( $_POST['review_rating'] ) ? intval( $_POST['review_rating'] ) : 0;
	$content   = isset( $_POST['review_content'] ) ? wp_kses_post( $_POST['review_content'] ) : '';

	if ( ! $recipe_id || ! $title || ! $rating || ! $content ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'kitchenary' ) ) );
	}

	$current_user = wp_get_current_user();
	$has_reviewed = get_posts(
		array(
			'post_type'      => 'recipe_review',
			'posts_per_page' => 1,
			'meta_key'       => '_recipe_review_recipe_id',
			'meta_value'     => $recipe_id,
			'author'         => $current_user->ID,
		)
	);

	if ( $has_reviewed ) {
		wp_send_json_error( array( 'message' => __( 'You have already reviewed this recipe.', 'kitchenary' ) ) );
	}

	$review_id = wp_insert_post(
		array(
			'post_title'   => $title,
			'post_content' => $content,
			'post_status'  => 'publish',
			'post_type'    => 'recipe_review',
			'post_author'  => $current_user->ID,
		)
	);

	if ( is_wp_error( $review_id ) ) {
		wp_send_json_error( array( 'message' => __( 'Error creating review. Please try again.', 'kitchenary' ) ) );
	}

	update_post_meta( $review_id, '_recipe_review_rating', $rating );
	update_post_meta( $review_id, '_recipe_review_recipe_id', $recipe_id );
	update_post_meta( $review_id, '_recipe_review_helpful_votes', 0 );

	wp_send_json_success( array( 'message' => __( 'Review submitted successfully.', 'kitchenary' ) ) );
}
add_action( 'wp_ajax_submit_recipe_review', 'kitchenary_handle_recipe_review_submission' );

/**
 * Handle recipe review helpful vote.
 */
function kitchenary_handle_recipe_review_vote() {
	check_ajax_referer( 'recipe_review_vote', 'nonce' );

	$review_id = isset( $_POST['review_id'] ) ? intval( $_POST['review_id'] ) : 0;
	if ( ! $review_id ) {
		wp_send_json_error( array( 'message' => __( 'Invalid review.', 'kitchenary' ) ) );
	}

	$helpful_votes = get_post_meta( $review_id, '_recipe_review_helpful_votes', true );
	$helpful_votes = $helpful_votes ? $helpful_votes : 0;
	$helpful_votes++;

	update_post_meta( $review_id, '_recipe_review_helpful_votes', $helpful_votes );

	wp_send_json_success( array( 'votes' => $helpful_votes ) );
}
add_action( 'wp_ajax_vote_recipe_review', 'kitchenary_handle_recipe_review_vote' );
add_action( 'wp_ajax_nopriv_vote_recipe_review', 'kitchenary_handle_recipe_review_vote' );

/**
 * Enqueue recipe review scripts.
 */
function kitchenary_enqueue_recipe_review_scripts() {
	if ( is_singular( 'recipe' ) ) {
		wp_enqueue_script(
			'recipe-reviews',
			get_template_directory_uri() . '/js/recipe-reviews.js',
			array( 'jquery' ),
			KITCHENARY_VERSION,
			true
		);

		wp_localize_script(
			'recipe-reviews',
			'recipeReviews',
			array(
				'nonce' => wp_create_nonce( 'recipe_review_vote' ),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'kitchenary_enqueue_recipe_review_scripts' );

require_once get_template_directory() . '/inc/class-kitchenary-footer-menu-walker.php';
require_once get_template_directory() . '/inc/class-kitchenary-footer-links-walker.php';
