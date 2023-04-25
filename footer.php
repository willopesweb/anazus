<?php
if (!isset($page_home_id)) :
  $page_home_id = get_option('page_on_front');
endif;
?>

<?php
/* <article class="l-newsletter">
  <div class="l-newsletter__content">
    <header class="l-newsletter__header">
      <span class="icon-mail"></span>
      <h2 class="l-newsletter__title">Receba um cupom com 10% de desconto</h2>
      <p class="l-newsletter__subtitle">Assine nossa newsletter e receba via email</p>
    </header>
    <form class="l-newsletter__form" action="">
      <label for="email" class="screen-readers-only">Digite o seu email</label>
      <input class="l-newsletter__input" type="text" name="email" placeholder="Digite seu email">
      <input type="submit" class="c-button c-button--primary" value="Enviar" />
    </form>
  </div>
</article> 


<div class="c-cookiebar js-cookie-bar">
  <div class="c-cookiebar__content">
    <p>Este site usa cookies para que possamos oferecer a melhor experiência de usuário possível. As informações de cookies são armazenadas em seu navegador e executam funções como reconhecê-lo quando você retorna ao nosso site e ajudar nossa equipe a entender quais seções do site você considera mais interessantes e úteis.</p>
    <button class="c-button c-button--primary js-cookie-btn">Aceitar</button>
  </div>
</div> */

?>

<footer class="l-footer">
  <div class="l-footer__content">
    <article class="l-footer__contact">
      <h2 class="l-footer__title">Precisa de ajuda para comprar?</h2>
      <p class="l-footer__subtitle">Entre em contato! Nos te ajudamos</p>
      <span class="l-footer__contact-info icon-whatsapp"><a href="https://api.whatsapp.com/send?phone=5519<?= str_replace(' ', '', get_field("telefone", $page_home_id)); ?>" target="_blank" class="l-page-contact__contact-number">
          (19) <?= get_field("telefone", $page_home_id); ?>
        </a></span>
      <span class="l-footer__contact-info icon-mail"><a class="l-page-contact__email" href="mailto: <?= get_field("email", $page_home_id); ?>" target="_blank">
          <?= get_field("email", $page_home_id); ?>
        </a></span>
      <p class="l-footer__contact-info">Horário de Atendimento: Segunda à sábado - 9h às 17h</p>
    </article>

    <nav class="l-footer__menu">
      <h2 class="l-footer__title">Mapa do Site</h2>
      <?php
      wp_nav_menu([
        'menu' => 'Menu Rodapé',
        'menu_class'   => 'l-footer__menu-list',
      ]);
      ?>
    </nav>

    <article class="l-footer__payments">
      <h2 class="l-footer__title">Formas de Pagamento</h2>
      <img loading="lazy" height="54px" width="213px" src="<?=  get_stylesheet_directory_uri() . "/" . ASSETS_DIR . '/img/pagseguro.png'; ?>" alt="Pagseguro">
      <img loading="lazy" height="81px" width="227" style="margin-top:10px" src="<?= get_stylesheet_directory_uri() . "/" . ASSETS_DIR . '/img/payments.png'; ?>" alt="Formas de Pagamento">
      <h2 class="l-footer__title">Certificado de Segurança</h2>
      <div class="l-footer__ssl">
        <img loading="lazy" height="57px" width="50px" src="<?= get_stylesheet_directory_uri() . "/" . ASSETS_DIR . '/img/ssl.png'; ?>" alt="Site Seguro">
        <div>
          <p>Compra Segura</p>
          <p>Certificado SSL</p>
        </div>


      </div>
    </article>
  </div>

  <div class="l-footer__subfooter">
    <div class="l-footer__subfooter-content">
      <p>Copyright ® <?= date('Y') ?> Ateliê AnazuS CNPJ: 34.113.625/0001-81 - Todos os Direitos Reservados - Imagens meramente ilustrativas.</p>
      <p>Os preços, promoções, condições de pagamento, frete e produtos são válidos exclusivamente para compras realizadas via internet.</p>
    </div>
  </div>


  <?php
  wp_footer();
  ?>
  <script src="<?= get_stylesheet_directory_uri() . '/' . ASSETS_DIR  ?>/js/main.js"></script>
</footer>

</body>


</html>