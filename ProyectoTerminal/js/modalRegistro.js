const openModal = document.querySelector('.btnRegistrar');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.btnCancelar');

openModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.add('modal--show');
});

closeModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.remove('modal--show');
});
