<?php
/**
 * Template part for displaying footer.
 *
 * @package Kitchenary
 */

// Get menu locations
$menu_locations = get_nav_menu_locations();
$left_menu      = isset( $menu_locations['footer-left-menu'] ) ? wp_get_nav_menu_object( $menu_locations['footer-left-menu'] ) : null;
$right_menu     = isset( $menu_locations['footer-right-menu'] ) ? wp_get_nav_menu_object( $menu_locations['footer-right-menu'] ) : null;

?>
<footer class="bg-gray-900 text-gray-300 py-12 fade-in">
	<div class="container mx-auto px-4">
		<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
			<div>
				<div class="flex items-center space-x-2 mb-4">
					<i class="fas fa-utensils text-2xl text-amber-500"></i>
					<h3 class="text-xl font-bold text-white"><?php bloginfo( 'name' ); ?><span class="text-amber-400">FSE</span></h3>
				</div>
				<p class="mb-4"><?php esc_html_e( 'Delicious recipes for every home cook. From quick weeknight meals to impressive dinner party dishes.', 'kitchenary' ); ?></p>
				<div class="flex space-x-4">
					<a href="#" class="text-gray-400 hover:text-amber-400 transition"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="text-gray-400 hover:text-amber-400 transition"><i class="fab fa-instagram"></i></a>
					<a href="#" class="text-gray-400 hover:text-amber-400 transition"><i class="fab fa-pinterest-p"></i></a>
					<a href="#" class="text-gray-400 hover:text-amber-400 transition"><i class="fab fa-youtube"></i></a>
				</div>
			</div>
			
			<div>
				<h4 class="text-white font-semibold text-lg mb-4">
					<?php echo $left_menu ? esc_html( $left_menu->name ) : ''; ?>
				</h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-left-menu',
						'menu_class'     => 'space-y-2',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 1,
						'link_before'    => '',
						'link_after'     => '',
						'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
						'walker'         => new Kitchenary_Footer_Menu_Walker(),
					)
				);
				?>
			</div>
			
			<div>
				<h4 class="text-white font-semibold text-lg mb-4">
					<?php echo $right_menu ? esc_html( $right_menu->name ) : ''; ?>
				</h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-right-menu',
						'menu_class'     => 'space-y-2',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 1,
						'link_before'    => '',
						'link_after'     => '',
						'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
						'walker'         => new Kitchenary_Footer_Menu_Walker(),
					)
				);
				?>
			</div>
			
			<div>
				<h4 class="text-white font-semibold text-lg mb-4"><?php esc_html_e( 'Contact Us', 'kitchenary' ); ?></h4>
				<ul class="space-y-2">
					<li class="flex items-start">
						<i class="fas fa-map-marker-alt text-amber-400 mt-1 mr-2"></i>
						<span><?php esc_html_e( '123 Food Street, Culinary City', 'kitchenary' ); ?></span>
					</li>
					<li class="flex items-center">
						<i class="fas fa-phone-alt text-amber-400 mr-2"></i>
						<span><?php esc_html_e( '+1 (555) 123-4567', 'kitchenary' ); ?></span>
					</li>
					<li class="flex items-center">
						<i class="fas fa-envelope text-amber-400 mr-2"></i>
						<span><?php esc_html_e( 'hello@gourmetfse.com', 'kitchenary' ); ?></span>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
			<p><?php printf( esc_html__( '© %1$d %2$s. All rights reserved.', 'kitchenary' ), date( 'Y' ), get_bloginfo( 'name' ) ); ?></p>
			<div class="flex space-x-6 mt-4 md:mt-0">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-links',
						'menu_class'     => 'flex space-x-6',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 1,
						'link_before'    => '',
						'link_after'     => '',
						'items_wrap'     => '%3$s',
						'walker'         => new Kitchenary_Footer_Menu_Walker(),
					)
				);
				?>
			</div>
		</div>
	</div>
</footer> 
