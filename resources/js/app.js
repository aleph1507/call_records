require('./bootstrap');
require('./Modal');
const {ConfirmationModal} = require('./ConfirmationModal')

window.addEventListener('DOMContentLoaded', e => {
    const btnMobileMenu = document.querySelector("button.mobile-menu-button");
    const mobileMenu = document.querySelector(".mobile-menu");

    btnMobileMenu.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

    let formConfirmables = document.querySelectorAll('.form.confirmable');

    for(let i = 0; i < formConfirmables.length; i++) {
        formConfirmables[i].addEventListener('submit', event => {
            event.preventDefault();
            let cm = new ConfirmationModal(formConfirmables[i]);
            cm.display();
        });
    }
});
