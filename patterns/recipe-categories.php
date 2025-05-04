<?php
/**
 * Title: Recipe Categories
 * Slug: kitchenary/recipe-categories
 * Categories: featured
 * Description: A grid of recipe categories with icons and counts.
 */

?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group py-12 bg-white fade-in" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
	<h2 class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50);font-style:normal;font-weight:600">Recipe Categories</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|24","left":"var:preset|spacing|24"}}},"className":"recipe-categories-grid"} -->
	<div class="wp-block-group alignwide recipe-categories-grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:var(--wp--preset--spacing--24)">
		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|24","right":"var:preset|spacing|24","bottom":"var:preset|spacing|24","left":"var:preset|spacing|24"}},"color":{"background":"var(--wp--preset--color--amber-50)"},"border":{"radius":"12px"}},"className":"recipe-category-card group"} -->
		<div class="wp-block-group recipe-category-card group" style="border-radius:12px;background-color:var(--wp--preset--color--amber-50);padding-top:var(--wp--preset--spacing--24);padding-right:var(--wp--preset--spacing--24);padding-bottom:var(--wp--preset--spacing--24);padding-left:var(--wp--preset--spacing--24)">
			<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|16"}}},"className":"recipe-category-icon"} -->
			<div class="wp-block-group recipe-category-icon" style="margin-bottom:var(--wp--preset--spacing--16)">
				<!-- wp:html -->
				<div class="bg-amber-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center group-hover:bg-amber-200 transition">
					<i class="fas fa-bread-slice text-amber-700 text-2xl"></i>
				</div>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->
			<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","right":"0","bottom":"var:preset|spacing|4","left":"0"}}}} -->
			<h3 class="has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:var(--wp--preset--spacing--4);margin-left:0;font-weight:600">Baking</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"var(--wp--preset--color--gray-600)"},"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
			<p class="has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;color:var(--wp--preset--color--gray-600);font-size:0.875rem">56 Recipes</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|24","right":"var:preset|spacing|24","bottom":"var:preset|spacing|24","left":"var:preset|spacing|24"}},"color":{"background":"var(--wp--preset--color--amber-50)"},"border":{"radius":"12px"}},"className":"recipe-category-card group"} -->
		<div class="wp-block-group recipe-category-card group" style="border-radius:12px;background-color:var(--wp--preset--color--amber-50);padding-top:var(--wp--preset--spacing--24);padding-right:var(--wp--preset--spacing--24);padding-bottom:var(--wp--preset--spacing--24);padding-left:var(--wp--preset--spacing--24)">
			<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|16"}}},"className":"recipe-category-icon"} -->
			<div class="wp-block-group recipe-category-icon" style="margin-bottom:var(--wp--preset--spacing--16)">
				<!-- wp:html -->
				<div class="bg-amber-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center group-hover:bg-amber-200 transition">
					<i class="fas fa-leaf text-amber-700 text-2xl"></i>
				</div>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->
			<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","right":"0","bottom":"var:preset|spacing|4","left":"0"}}}} -->
			<h3 class="has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:var(--wp--preset--spacing--4);margin-left:0;font-weight:600">Vegan</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"var(--wp--preset--color--gray-600)"},"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
			<p class="has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;color:var(--wp--preset--color--gray-600);font-size:0.875rem">32 Recipes</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|24","right":"var:preset|spacing|24","bottom":"var:preset|spacing|24","left":"var:preset|spacing|24"}},"color":{"background":"var(--wp--preset--color--amber-50)"},"border":{"radius":"12px"}},"className":"recipe-category-card group"} -->
		<div class="wp-block-group recipe-category-card group" style="border-radius:12px;background-color:var(--wp--preset--color--amber-50);padding-top:var(--wp--preset--spacing--24);padding-right:var(--wp--preset--spacing--24);padding-bottom:var(--wp--preset--spacing--24);padding-left:var(--wp--preset--spacing--24)">
			<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|16"}}},"className":"recipe-category-icon"} -->
			<div class="wp-block-group recipe-category-icon" style="margin-bottom:var(--wp--preset--spacing--16)">
				<!-- wp:html -->
				<div class="bg-amber-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center group-hover:bg-amber-200 transition">
					<i class="fas fa-drumstick-bite text-amber-700 text-2xl"></i>
				</div>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->
			<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","right":"0","bottom":"var:preset|spacing|4","left":"0"}}}} -->
			<h3 class="has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:var(--wp--preset--spacing--4);margin-left:0;font-weight:600">Protein</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"var(--wp--preset--color--gray-600)"},"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
			<p class="has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;color:var(--wp--preset--color--gray-600);font-size:0.875rem">48 Recipes</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|24","right":"var:preset|spacing|24","bottom":"var:preset|spacing|24","left":"var:preset|spacing|24"}},"color":{"background":"var(--wp--preset--color--amber-50)"},"border":{"radius":"12px"}},"className":"recipe-category-card group"} -->
		<div class="wp-block-group recipe-category-card group" style="border-radius:12px;background-color:var(--wp--preset--color--amber-50);padding-top:var(--wp--preset--spacing--24);padding-right:var(--wp--preset--spacing--24);padding-bottom:var(--wp--preset--spacing--24);padding-left:var(--wp--preset--spacing--24)">
			<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|16"}}},"className":"recipe-category-icon"} -->
			<div class="wp-block-group recipe-category-icon" style="margin-bottom:var(--wp--preset--spacing--16)">
				<!-- wp:html -->
				<div class="bg-amber-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center group-hover:bg-amber-200 transition">
					<i class="fas fa-glass-whiskey text-amber-700 text-2xl"></i>
				</div>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->
			<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","right":"0","bottom":"var:preset|spacing|4","left":"0"}}}} -->
			<h3 class="has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:var(--wp--preset--spacing--4);margin-left:0;font-weight:600">Drinks</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"var(--wp--preset--color--gray-600)"},"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
			<p class="has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;color:var(--wp--preset--color--gray-600);font-size:0.875rem">24 Recipes</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group --> 