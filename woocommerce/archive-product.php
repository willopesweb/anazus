<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header();

$products = [];

if (have_posts()) :
	while (have_posts()) :
		the_post();
		$products[] = wc_get_product(get_the_ID());
	endwhile;
endif;

$data = [];
$data['products'] = format_products($products);
?>


<main class='l-products-archive'>
	<div class="c-breadcrumb">
		<?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
	</div>

	<section>
		<div class="l-page__content">
			<header class="l-page__header">
				<h1 class="l-page__title"><?php woocommerce_page_title(); ?></h1>
			</header>
		</div>
		<div class="l-products-archive__content">
			<?php
			if ($data['products'][0]) :
				woocommerce_catalog_ordering();
				theme_products_list($data['products']);
				echo get_the_posts_pagination();
			else : ?>
				<p class="l-products-archive__notfound">Nenhum resultado encontrado para a sua busca!</p>
			<?php endif;
			?>
		</div>
	</section>
</main>


<?php
get_footer();
