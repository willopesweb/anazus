<?php
// Template Name: Página Template
get_header();
$img_url = get_stylesheet_directory_uri() . "/" . ASSETS_DIR . '/img';

?>

<main class="l-page">
  <section class="l-page__content">
    <div class="l-page__header">
      <h1 class="l-page__title"><?= get_the_title() ?></h1>
    </div>
    <div class="l-page__text">
      <?= get_the_content() ?>
    </div>
  </section>
</main>

<?php
get_footer();
