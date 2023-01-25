// Modal
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.remove('is-disabled');
      modal.classList.add('is-active');
      document.body.classList.add('is-modal-open');
      modal.addEventListener('click', (e) => {
        if (
          e.target.id === modalId
          || e.target.classList.contains('c-modal__close')
        ) {
          modal.classList.remove('is-active');
          document.body.classList.remove('is-modal-open');
        }
      });
    }
  }
  
  const btnModal = document.querySelectorAll('.js-open-modal');
  if (btnModal) {
    btnModal.forEach((btn) => {
      btn.addEventListener('click', () => {
        openModal(btn.getAttribute('data-modal'));
      });
    });
  }