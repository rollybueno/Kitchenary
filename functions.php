<?php
/**
 * Kitchenary functions and definitions
 *
 * @package Kitchenary
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

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

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 40,
			'width'       => 40,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for custom color palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Amber 50', 'kitchenary' ),
				'slug'  => 'amber-50',
				'color' => '#FFFBEB',
			),
			array(
				'name'  => __( 'Amber 100', 'kitchenary' ),
				'slug'  => 'amber-100',
				'color' => '#FEF3C7',
			),
			array(
				'name'  => __( 'Amber 400', 'kitchenary' ),
				'slug'  => 'amber-400',
				'color' => '#FBBF24',
			),
			array(
				'name'  => __( 'Amber 500', 'kitchenary' ),
				'slug'  => 'amber-500',
				'color' => '#F59E0B',
			),
			array(
				'name'  => __( 'Amber 600', 'kitchenary' ),
				'slug'  => 'amber-600',
				'color' => '#D97706',
			),
			array(
				'name'  => __( 'Amber 700', 'kitchenary' ),
				'slug'  => 'amber-700',
				'color' => '#B45309',
			),
			array(
				'name'  => __( 'Gray 50', 'kitchenary' ),
				'slug'  => 'gray-50',
				'color' => '#F9FAFB',
			),
			array(
				'name'  => __( 'Gray 800', 'kitchenary' ),
				'slug'  => 'gray-800',
				'color' => '#1F2937',
			),
			array(
				'name'  => __( 'Gray 900', 'kitchenary' ),
				'slug'  => 'gray-900',
				'color' => '#111827',
			),
			array(
				'name'  => __( 'White', 'kitchenary' ),
				'slug'  => 'white',
				'color' => '#FFFFFF',
			),
		)
	);

	// Add support for custom font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => __( 'Small', 'kitchenary' ),
				'size' => 14,
				'slug' => 'small',
			),
			array(
				'name' => __( 'Normal', 'kitchenary' ),
				'size' => 16,
				'slug' => 'normal',
			),
			array(
				'name' => __( 'Large', 'kitchenary' ),
				'size' => 20,
				'slug' => 'large',
			),
			array(
				'name' => __( 'Huge', 'kitchenary' ),
				'size' => 36,
				'slug' => 'huge',
			),
		)
	);
}
add_action( 'after_setup_theme', 'kitchenary_setup' );

/**
 * Enqueue scripts and styles.
 */
function kitchenary_scripts() {
	// Enqueue Font Awesome
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

	// Enqueue Tailwind CSS
	wp_enqueue_style( 'tailwind', 'https://cdn.tailwindcss.com', array(), null );

	// Enqueue custom JavaScript
	wp_enqueue_script( 'kitchenary-script', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'kitchenary_scripts' );

/**
 * Register navigation menus.
 */
function kitchenary_register_menus() {
	register_nav_menus(
		array(
			'primary'            => __( 'Primary Menu', 'kitchenary' ),
			'footer-quick-links' => __( 'Footer Quick Links', 'kitchenary' ),
			'footer-categories'  => __( 'Footer Categories', 'kitchenary' ),
			'footer-legal'       => __( 'Footer Legal', 'kitchenary' ),
		)
	);
}
add_action( 'init', 'kitchenary_register_menus' );

/**
 * Add custom block styles.
 */
function kitchenary_register_block_styles() {
	// Register rounded button style
	register_block_style(
		'core/button',
		array(
			'name'  => 'rounded',
			'label' => __( 'Rounded', 'kitchenary' ),
		)
	);
}
add_action( 'init', 'kitchenary_register_block_styles' );
