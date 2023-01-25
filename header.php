<!DOCTYPE html>
<html lang="pt-br">

<?php

$title = is_front_page() ? get_option('blogname') : get_the_title() . ' - ' . get_option('blogname');
$img_url = get_stylesheet_directory_uri() . "/" . ASSETS_DIR . '/img';
$cart_count = WC()->cart->get_cart_contents_count();

if (!isset($page_home_id)) :
  $page_home_id = get_option('page_on_front');
endif;

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $title ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php wp_head(); ?>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
</head>



<body <?php body_class(); ?>>
  <div class="l-header__wrapper">
    <div class="l-header__top">
      <div class="l-header__top-content">
        <a class="l-header__top-logo" href="<?= get_home_url(); ?>">
          <img width="300" height="100" src="<?= $img_url; ?>/logo.svg" alt=" <?php bloginfo('name'); ?>" />
        </a>
        <?= theme_social_networks();?>
      </div>
    </div>
    <header class="l-header">
      <div class="l-header__content">
        <h1 class="screen-readers-only"><?php wp_title(); ?> - <?php bloginfo('name'); ?></h1>
        <a class="l-header__logo l-header__logo--show-on-desktop" href="<?= get_home_url(); ?>">
          <img height="120" width="120" src="<?= $img_url; ?>/logo.png" alt=" <?php bloginfo('name'); ?>" />
        </a>
        <div class="l-header__menu">
          <span class="c-nav__close js-toogle-menu">X</span>
          <?php
          wp_nav_menu([
            'menu' => 'Menu Header',
            'container' => 'nav',
            'container_aria_label' => 'Menu Principal',
            'container_class' => 'c-nav js-mobile-menu',
            'menu_class'   => 'c-nav__menu',
          ]);
          ?>
        </div>

        <div class="l-header__actions">
          <a href="<?= get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="icon-user" title="Minha Conta"></a>
          <a href="<?= wc_get_cart_url() ?>" class="icon-shop" title="Carrinho">
            <?php if ($cart_count) : ?>
              <span class='l-header__cart-count'><?= $cart_count ?></span>
            <?php endif; ?>
          </a>
          <!--<a href="#" class="icon-clipboard" title="Orçamento"></a> -->
          <span class="icon-search js-toogle-search"></span>
          <span class="icon-menu l-header__mobile-btn  js-toogle-menu"></span>
        </div>

      </div>
    </header>
  </div>
  <div class="l-search js-search-form">
    <div class="l-search__content ">
      <span class="l-search__close js-toogle-search">X</span>
      <form action="<?= get_permalink(wc_get_page_id('shop')); ?>" method="get" class="l-search__form">
        <label class="screen-readers-only" for="s">Pesquisar por:</label>
        <input type="text" name="s" placeholder="O que você está procurando?" value="<?php the_search_query(); ?>" class="l-search__input">
        <input type="hidden" name="post_type" value="product">
        <input type="submit" value="Buscar" id="searchbutton" class="c-button c-button--primary">
      </form>
    </div>
  </div>




  <script async>
    // Mostra Barra de Pesquisa
    const searchToogle = document.querySelectorAll('.js-toogle-search');
    const searchForm = document.querySelector('.js-search-form');

    searchToogle.forEach(toogle => {
      toogle.addEventListener("click", () => {
        searchForm.classList.toggle('is-toogled');
      });
    })

    // Abre Menu Mobile
    const menuToogle = document.querySelectorAll('.js-toogle-menu')
    const menu = document.querySelector('.js-mobile-menu');

    menuToogle.forEach(toogle => {
      toogle.addEventListener("click", () => {
        menu.classList.toggle('is-toogled')
        document.body.classList.toggle("is-menu-open");
      });
    })
  </script>