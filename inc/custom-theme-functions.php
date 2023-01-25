<?php

// Retorna redes sociais
function theme_social_networks()
{

  if (!isset($page_home_id)) :
    $page_home_id = get_option('page_on_front');
  endif;


  $html = '';
  $html .= '<ul class="c-social">';
  $html .= '<li><a href="https://api.whatsapp.com/send?phone=5519' . str_replace(' ', '', get_field("whatsapp", $page_home_id)) . '" class="icon-whatsapp" target="_blank"></a></li>';
  $html .= '<li><a class="icon-instagram" href="' . get_field("instagram", $page_home_id) . '" title="Nos Siga no Instagram" target="_blank" rel="_nofollow"></a></li>';
  $html .= '<li><a class="icon-facebook" href="' . get_field("facebook", $page_home_id) . '" title="Curta nossa página no Facebook" target="_blank" rel="_nofollow"></a></li>';
  $html .= '</ul>';

  return $html;
}
