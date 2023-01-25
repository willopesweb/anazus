<?php
// Template Name: Contato

get_header();

if (!isset($page_home_id)) :
  $page_home_id = get_option('page_on_front');
endif;

?>
<main class="l-page-contact" id="contato">
  <div class="l-page-contact__content">
    <div class="l-page__header">
      <h1 class="l-page__title">Contato</h1>
    </div>
    <article class="l-page-contact__address">
      <div>
        <h2 class="l-page-contact__title">Endereço</h2>
        <p><?= get_field("endereco", $page_home_id); ?></p>
      </div>
      <div>
        <h2 class="l-page-contact__title">Telefone</h2>
        <span class="icon-whatsapp"><a href="https://api.whatsapp.com/send?phone=5519<?= str_replace(' ', '', get_field("telefone", $page_home_id)); ?>" target="_blank" class="l-page-contact__contact-number">
            (19) <?= get_field("telefone", $page_home_id); ?>
          </a></span>
      </div>
      <div>
        <h2 class="l-page-contact__title">Email</h2>
        <span class="icon-mail"><a class="l-page-contact__email" href="mailto: <?= get_field("email", $page_home_id); ?>" target="_blank">
            <?= get_field("email", $page_home_id); ?>
          </a></span>
      </div>
    </article>



    <article class="l-page-contact__form">
      <?= do_shortcode('[contact-form-7 id="176" title="Formulário de Contato"]'); ?>
    </article>

  </div>

</main>

<?php
get_footer();
