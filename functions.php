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
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
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
	/**
	 * Starts the element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Add Tailwind CSS classes.
		$classes[] = 'text-gray-600';
		$classes[] = 'hover:text-amber-500';
		$classes[] = 'transition';

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener';
		} else {
			$atts['rel'] = $item->xfn;
		}
		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
		$atts['aria-current'] = $item->current ? 'page' : '';

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
 * Custom menu walker for footer menu
 */
class Kitchenary_Footer_Menu_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$output .= '<li>';
		$output .= '<a href="' . esc_url( $item->url ) . '" class="hover:text-amber-400 transition">';
		$output .= esc_html( $item->title );
		$output .= '</a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}

/**
 * Enqueue scripts and styles.
 */
function kitchenary_scripts() {
	// Enqueue Tailwind CSS with configuration.
	wp_enqueue_script( 'tailwind-config', 'https://cdn.tailwindcss.com', array(), KITCHENARY_VERSION, false );
	wp_add_inline_script(
		'tailwind-config',
		'tailwind.config = ' . json_encode(
			array(
				'content' => array(
					'./*.php',
					'./template-parts/**/*.php',
					'./inc/**/*.php',
					'./js/**/*.js',
				),
				'theme'   => array(
					'extend' => array(
						'colors' => array(
							'amber' => array(
								50  => '#fffbeb',
								100 => '#fef3c7',
								200 => '#fde68a',
								300 => '#fcd34d',
								400 => '#fbbf24',
								500 => '#f59e0b',
								600 => '#d97706',
								700 => '#b45309',
								800 => '#92400e',
								900 => '#78350f',
							),
						),
					),
				),
			)
		)
	);

	// Enqueue Font Awesome.
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

	// Enqueue theme stylesheet.
	wp_enqueue_style( 'kitchenary-style', get_stylesheet_uri(), array(), KITCHENARY_VERSION );
	wp_style_add_data( 'kitchenary-style', 'rtl', 'replace' );

	// Enqueue theme script.
	wp_enqueue_script( 'kitchenary-navigation', get_template_directory_uri() . '/js/navigation.js', array(), KITCHENARY_VERSION, true );

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
