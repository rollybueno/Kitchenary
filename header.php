<?php
/**
 * The header for our theme
 *
 * @package Kitchenary
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'kitchenary' ); ?></a>

	<header id="masthead" class="bg-white shadow-sm sticky top-0 z-50 fade-in">
		<div class="container mx-auto px-4 py-3 flex justify-between items-center">
			<div class="flex items-center space-x-2">
				<i class="fas fa-utensils text-2xl text-amber-600"></i>
				<h1 class="text-2xl font-bold text-amber-700">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			</div>

			<nav id="site-navigation" class="main-navigation hidden md:flex space-x-8">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'flex space-x-8',
						'container'      => false,
						'fallback_cb'    => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'walker'         => new Kitchenary_Walker_Nav_Menu(),
					)
				);
				?>
			</nav>

			<div class="flex items-center space-x-4">
				<button class="md:hidden text-gray-600" aria-controls="primary-menu" aria-expanded="false">
					<i class="fas fa-bars text-xl"></i>
				</button>
				<button class="bg-amber-600 text-white px-4 py-2 rounded-full hover:bg-amber-700 transition flex items-center">
					<i class="fas fa-search mr-2"></i>
					<span class="hidden md:inline"><?php esc_html_e( 'Search', 'kitchenary' ); ?></span>
				</button>
			</div>
		</div>
	</header> 