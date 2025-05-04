<?php
/**
 * The template for displaying the footer
 *
 * @package Kitchenary
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer-widgets">
				<div class="footer-widget">
					<h3 class="widget-title"><?php esc_html_e( 'About Us', 'kitchenary' ); ?></h3>
					<p><?php esc_html_e( 'Welcome to our food blog where we share delicious recipes and cooking tips.', 'kitchenary' ); ?></p>
				</div>

				<div class="footer-widget">
					<h3 class="widget-title"><?php esc_html_e( 'Quick Links', 'kitchenary' ); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_class'     => 'footer-menu',
							'container'      => false,
						)
					);
					?>
				</div>

				<div class="footer-widget">
					<h3 class="widget-title"><?php esc_html_e( 'Follow Us', 'kitchenary' ); ?></h3>
					<div class="social-links">
						<a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
						<a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
						<a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
						<a href="#" class="social-link"><i class="fab fa-pinterest"></i></a>
					</div>
				</div>
			</div>

			<div class="site-info">
				<p>
					<?php
					printf(
						/* translators: %1$s: Current year, %2$s: Site name */
						esc_html__( '© %1$s %2$s. All rights reserved.', 'kitchenary' ),
						esc_html( date_i18n( 'Y' ) ),
						'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'
					);
					?>
				</p>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html> 