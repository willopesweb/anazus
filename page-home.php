<?php
// Template Name: Home
get_header();
$img_url = get_stylesheet_directory_uri() . "/" . ASSETS_DIR . '/img';

$page_home_id = get_option('page_on_front');

$products_new = wc_get_products([
  'limit' => 4,
  'orderby' => 'date',
  'order' => 'DESC',
  'stock_status' => 'instock'
]);

$products_sales = wc_get_products([
  'limit' => 8,
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'order' => 'DESC',
  'stock_status' => 'instock'
]);

$data = [];

$data['lancamentos'] = format_products($products_new, 'medium');
$data['vendidos'] = format_products($products_sales, 'medium');

?>

<script async>
  // Menu Fixo
  const header = document.querySelector(".l-header");
  document.addEventListener("scroll", () => {
    if (window.pageYOffset > 100) {
      header.classList.add("is-fixed");
    } else {
      header.classList.remove("is-fixed");
    }
  })
</script>
<ul class="l-slides">
  <?php {
    global $query_string;
    parse_str($query_string, $my_query_array);

    $args = array(
      'post_type' => 'slide',
      'post_status' => 'publish',
      'order' => 'ASC',
      'orderby' => 'post-date'
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $slide = array(
          'title' => get_the_title(),
          'image' => get_field("slide_image"),
          'subtitle' => get_field("slide_subtitle"),
          'link' => get_field("slide_link")
        );

        echo '<li class="l-slides__item" style="background-image: url(' . $slide["image"] . ')">';
        echo '<article class="l-slides__content">';
        echo '<header class="l-slides__header">';
        echo '<h1 class="l-slides__title">' . $slide["title"] . '</h1>';
        echo '<p class="l-slides__subtitle">' . $slide["subtitle"] . '</p>';
        echo '</header>';
        echo '</article>';
        echo '</li>';
      }
    }
  }

  ?>
</ul>

<main class="l-page">
  <section class="l-page-home__products">
    <div class="l-page__content">
      <header class="l-page__header">
        <h1 class="l-page__title">Novidades</h1>
      </header>
      <?php theme_products_list($data['lancamentos']); ?>
    </div>
  </section>
  <section class="l-page-about" style="background-image:url(<?= $img_url ?>/bg_img.jpg)">
    <div class="l-page-about__content">
      <img width="200" height="200" loading="lazy" src="<?= get_field("foto", $page_home_id) ?>" alt="Casal Suzana e Airton, os artesão responsáveis pelo site" class="l-page-about__image">
      <h1 class="l-page__title">Quem somos?</h1>
      <p class="l-page-about__text"><?= get_field("texto", $page_home_id) ?></p>
    </div>
  </section>
  <section class="l-page-home__products">
    <div class="l-page__content">
      <header class="l-page__header">
        <h1 class="l-page__title">Mais Vendidos</h1>
      </header>
      <?php theme_products_list($data['vendidos']); ?>
    </div>
  </section>
  </div>

</main>

<?php
get_footer();
