<?php
// Slides
function register_cpt_slides()
{
  $labels = array(
    'name' => _x('Slides', 'post type general name'),
    'singular_name' => _x('Slide', 'post type singular name'),
    'add_new' => __('Adicionar Slide'),
    'add_new_item' => __('Adicionar Novo Slide'),
    'edit_item' => __('Editar Slide'),
    'new_item' => __('Novo Slide'),
    'view_item' => __('Ver Slide'),
    'search_items' => __('Pequisar Slides'),
    'not_found' =>  __('Nenhum slide encontrado'),
    'not_found_in_trash' => __('Nenhum slide na Lixeira'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'description' => 'Cadastre os seus Slides',
    'public' => true,
    'menu_position' => 5, // Abaixo de 'Posts'
    'menu_icon' => 'dashicons-cover-image', // https://developer.wordpress.org/resource/dashicons/
    'capability_type' => 'post',
    'query_var' => true,
    'supports' => array('custom-fields', 'author', 'title'),
    'publicy_queryable' => true
  );

  register_post_type('slide', $args);
}

add_action('init', 'register_cpt_slides');


function slides_shortcode()
{
  $args = array(
    'post_type' => 'slide',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'ASC',
  );
  $html = '';
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $slide = array(
        'titulo' => get_the_title(),
        'imagem' => get_field("imagem"),
        'link' => get_field("link")
      );
      $html .= '<li class="splide__slide">';
      $html .= '<article class="c-slides__item">';
      $html .= '<a href="' . $slide["link"] . '" title="' . $slide["titulo"] . '">';
      $html .= '<img loadind="lazy" class="c-slides__image" src="' . $slide["imagem"] . '" alt="' . $slide["titulo"] . '">';
      $html .= '<h1 class="c-slides__title">' . $slide["titulo"] . '</h1>';
      $html .= '</a></article></li>';
    }
  }
  wp_reset_postdata();
  return $html;
}

add_shortcode('slides', 'slides_shortcode');
