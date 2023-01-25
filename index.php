<?php get_header(); ?>

<?php if (have_posts()) {
  while (have_posts()) {
    the_post(); ?>
    <h1 class="l-page__title"><?php the_title(); ?></h1>
    <main class="l-page__content"><?php the_content(); ?></main>
<?php }
} ?>

<?php get_footer(); ?>