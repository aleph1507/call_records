export class Modal
{
    constructor(modalId) {
        this.modal = document.getElementById(modalId);
        this.content = this.modal.querySelector('.modal-content');
        this.closeBtn = this.modal.querySelector('.modal-close');
        this.closeBtn.addEventListener('click', e => this.close());
        window.onclick = (e) => {
            if (e.target.classList.contains('modal')) {
                this.close();
            }
        }
    }

    display() {
        this.modal.style.display = 'block';
    }

    close() {
        document.querySelector('.modal').style.display = 'none';
    }
}
