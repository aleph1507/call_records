require('./bootstrap');
require('./Modal');
const {ConfirmationModal} = require('./ConfirmationModal')

window.addEventListener('DOMContentLoaded', e => {
    let formConfirmables = document.querySelectorAll('.form.confirmable');

    for(let i = 0; i < formConfirmables.length; i++) {
        formConfirmables[i].addEventListener('submit', event => {
            event.preventDefault();
            let cm = new ConfirmationModal(formConfirmables[i]);
            cm.display();
        });
    }
});
