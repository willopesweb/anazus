<?php
get_header();
?>

<main class="l-page-product">
  <div class="c-breadcrumb">
    <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
  </div>

  <div class="l-page-product__notifications">
    <?php wc_print_notices(); ?>
  </div>

  <div class="l-page-product__content">
    <?php
    // Loop
    if (have_posts()) :
      while (have_posts()) :
        the_post();
        $data['product'] = format_single_product(get_the_ID(), "large");
    ?>
        <div class="l-page-product__gallery" data-gallery='gallery'>
          <ul class="l-page-product__gallery-list">
            <?php foreach ($data['product']['gallery'] as $img) : ?>
              <li class="l-page-product__gallery-item">
                <img class="lazy js-load-image" data-src="<?= $img ?>" alt="<?= $data['product']['name']; ?>">
              </li>
            <?php
            endforeach;
            ?>
          </ul>
          <div class="l-page-product__gallery-main">
            <figure class="zoom js-zoom-area" onmousemove="zoom(event)" style="background-image:url(<?= $data['product']['img'] ?>)">
              <img class="lazy js-main-image" data-gallery='list' data-src="<?= $data['product']['img'] ?>" alt="<?= $data['product']['name']; ?>">
            </figure>
          </div>
        </div>
        <header class="l-page-product__header">
          <h1 class="l-page__title"><?= $data['product']['name'] ?></h1>
        </header>
        <div class="l-page-product__info">
          <p class="l-page-product__price"><?php echo $product->get_price_html(); ?></p>
          <?php woocommerce_template_single_add_to_cart(); ?>
          <div class="l-page-product__totals">
            <input class="js-price-value" type="hidden" value="<?= $data['product']['price_value'] ?>">
            <p class="l-page-product__totals-quantity js-quantity-total"></p>
            <p class="l-page-product__totals-value js-value-total"></p>
          </div>
        </div>
  </div>

  <article class="l-page-product__description">
    <header class="l-page__header">
      <h2 class="l-page__title">Descrição</h2>
    </header>
    <div class="l-page-product__description-content">
      <p><?= $data['product']['description'] ?></p>
    </div>
  </article>


<?php
      endwhile;
    endif;
?>
</div>



</main>


<section class="l-page-product__relateds">
  <div class="l-page-product__relateds-content">
    <?php
    // Produtos da mesma Categoria
    if (is_singular('product')) {

      global $post;

      // get categories
      $terms = wp_get_post_terms($post->ID, 'product_cat');
      foreach ($terms as $term) $cats_array[] = $term->term_id;

      $query_args = array(
        'post__not_in' => array($post->ID),
        'posts_per_page' => 4,
        'no_found_rows' => 1,
        'post_status' => 'publish',
        'post_type' => 'product',
        'tax_query' => array(
          array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $cats_array
          )
        )
      );

      $r = new WP_Query($query_args);

      if ($r->have_posts()) {
    ?>

        <header class="l-page__header">
          <h2 class="l-page__title">Você também vai gostar</h2>
        </header>
        <ul class='c-products-list'>
          <?php while ($r->have_posts()) : $r->the_post();
            global $product;
            $relatedProduct['name'] = esc_attr(get_the_title() ? get_the_title() : get_the_ID());
            $relatedProduct['link'] = get_the_permalink();
            $relatedProduct['price']  = $product->get_price_html();
            $relatedProduct['img'] = wp_get_attachment_image_src($product->get_image_id(), 'medium')[0];
            theme_single_product($relatedProduct);
          endwhile ?>
        </ul>

    <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_query();
      }
    }

    ?>
  </div>
</section>



<script async>
  const input = document.querySelector('.qty');
  const plusBtn = document.querySelector('.cart__quantity-control--plus');
  const minusBtn = document.querySelector('.cart__quantity-control--minus');
  const price = document.querySelector(".js-price-value").value;
  const totalValue = document.querySelector('.js-value-total');

  if (plusBtn) {
    plusBtn.addEventListener('click', () => {
      input.value = parseFloat(input.value) + 1;
      changeTotals(input.value);
    });
  }

  if (minusBtn) {
    minusBtn.addEventListener('click', () => {
      if (input.value > 1) {
        input.value = parseFloat(input.value) - 1;
        changeTotals(input.value);
      }
    });
  }

  if (input) {
    input.addEventListener('change', changeTotals(input.value));
  }


  function changeTotals(newValue) {
    const quantityValue = document.querySelector('.js-quantity-total');
    if (newValue == 1) {
      quantityValue.innerHTML = 'Total de <span>1</span> item';
    } else {
      quantityValue.innerHTML = `Total de <span>${newValue}</span> itens`;
    }

    totalValue.innerHTML = `Por <span>R$ ${(price * newValue).toFixed(2).replace('.',',')}</span>`;
  }

  // Galeria

  const mainImage = document.querySelector('.js-main-image');
  const mainImageSrc = mainImage.src;
  const images = document.querySelectorAll('.js-load-image');
  const zoomArea = document.querySelector('.js-zoom-area');

  // Ao passar o mouse pela imagem do produto, ela é carregada na imagem principal
  // Evento só ocorre após 1 segundo de hover, para evitar ativar acidentamente
  images.forEach((image) => {
    image.addEventListener('mouseover', () => {
      setTimeout(() => {
        changeMainImage(image)
      }, 300);
    });
    image.addEventListener('click', () => changeMainImage(image));
  });



  function changeMainImage(image) {
    mainImage.src = image.src;
    zoomArea.style.backgroundImage = `url(${image.src})`;
  }

  // Zoom Image
  function zoom(e) {
    let zoomer = e.currentTarget;
    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
    x = offsetX / zoomer.offsetWidth * 100
    y = offsetY / zoomer.offsetHeight * 100
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
    zoomer.style.backgroundImage = `url(${zoomer.querySelector('img').src})`;
  }
</script>
<?php
get_footer();
