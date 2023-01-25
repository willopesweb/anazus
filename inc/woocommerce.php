<?php

// GERAL
// Filtro para remover algumas classes do body com estilos padrão do WooCommerce
function remove_some_body_class($class)
{
  $woo_class = array_search('woocommerce', $class);
  $woopage_class = array_search('woocommerce-page', $class);

  // Filtrar as classes apenas das páginas Product e Product Archive
  $search = in_array('archive', $class) || in_array('product-template-default', $class);
  if (($woo_class || $woopage_class) && $search); {
    unset($class[$woo_class]);
    unset($class[$woopage_class]);
  }
  return $class;
}
add_filter('body_class', 'remove_some_body_class');


// Retorna Categorias
function theme_list_product_categories($parent = null, $number = null, $orderby = null, $order = null, $hide_empty = false, $ids = null)
{
  $args = array(
    'taxonomy'   => "product_cat",
    'number'     => $number,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids,
    'parent'    => $parent
  );

  $product_category = get_terms($args);

  $categories = [];
  foreach ($product_category as $category) :
    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
    $image = wp_get_attachment_url($thumbnail_id);
    $categories[] = [
      'id' => $category->term_id,
      'name' => $category->name,
      'link' => $category->slug,
      'count_products' => $category->count,
      'img' => $image
    ];
  endforeach;
  return $categories;
}

// Retorna um array formatado com as informações de cada produto
function format_products($products, $img_size = 'thumbnail')
{

  $products_final = [];
  foreach ($products as $product) :
    $products_final[] = [
      'id' => $product->get_ID(),
      'name' => $product->get_name(),
      'price' => $product->get_price_html(),
      'img' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
      'link' => $product->get_permalink()
    ];

  endforeach;


  return $products_final;
}

function theme_single_product($product, $carrousel = false)
{
?>
  <li <?php if ($carrousel) {
        echo "class='splide__slide'";
      } ?>>
    <article class="c-product">
      <a href="<?= $product['link'] ?>" title="<?= $product['name'] ?>" class="c-product__image">
        <img class="lazy" data-src="<?= $product['img'] ?>" alt="<?= $product['name'] ?>" width="500" height="500">
      </a>
      <div class="c-product__info">
        <span class="c-product__label">
          Disponível
        </span>
        <a href="" title="" class="c-product__link">
          <h1 class="c-product__title"><?= $product['name'] ?></h1>
        </a>
        <span class="c-product__price"><?= $product['price'] ?></span>
        <div class="c-product__actions">
          <a href="<?= $product['link'] ?>" title="<?= $product['name'] ?>" class="c-button c-button--primary">Ver mais</a>
        </div>
      </div>
    </article>
  </li>
<?php
}



// Recebe um array  com objetos do tipo produto e retorna html formatado
function theme_products_list($products, $carrousel = false)
{ ?>
  <ul class='c-products-list'>
    <?php foreach ($products as $product) :
      //Busca Categorias do produto
      $categories = get_the_terms($product['id'], 'product_cat');
      foreach ($categories as $category) :
        if ($category->parent == 0) {
          $product['parent_category']['id'] = $category->term_id;
          $product['parent_category']['name'] = $category->name;
          $product['parent_category']['link'] = get_site_url() . '/colecoes?=' . $category->slug;
        } else {
          $product['category']['id'] = $category->term_id;
          $product['category']['name'] = $category->name;
        }
      endforeach;
      theme_single_product($product,$carrousel);

    endforeach ?>
  </ul>
<?php }


// SINGLE PRODUCT
// Prepara os dados para exibir na página do Produto (Single Product)
function format_single_product($id, $img_size = 'medium')
{
  $product = wc_get_product($id);

  $gallery_ids = $product->get_gallery_image_ids();
  $gallery = [];

  if ($gallery_ids) :
    foreach ($gallery_ids as $img_id) :
      $gallery[] = wp_get_attachment_image_src($img_id, $img_size)[0];
    endforeach;
  endif;


  return [
    'id' => $id,
    'name' => $product->get_name(),
    'price' => $product->get_price_html(),
    'price_value' => $product->get_price(),
    'link' => $product->get_permalink(),
    'sku' => $product->get_sku(),
    'description' => $product->get_description(),
    'img' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
    'gallery' => $gallery
  ];
}

// Botões para alterar quantidade na página Single Product
function theme_add_to_cart_plus_button()
{
  echo "<div class='cart__quantity'><span class='cart__quantity-control cart__quantity-control--plus'>+</span>";
}
add_action('woocommerce_before_add_to_cart_quantity', 'theme_add_to_cart_plus_button');

function theme_add_to_cart_minus_button()
{
  echo "<span class='cart__quantity-control cart__quantity-control cart__quantity-control--minus'>-</span></div>";
}
add_action('woocommerce_after_add_to_cart_quantity', 'theme_add_to_cart_minus_button');

// ARCHIVE PRODUCTS
// Define quantidade de produtos exibidos por página
function theme_loop_shop_per_page()
{
  return 12;
}

add_filter('loop_shop_per_page', 'theme_loop_shop_per_page');