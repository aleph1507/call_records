import {Modal} from "./Modal";

export class ConfirmationModal extends Modal
{
    constructor(form, callbackCancel = null) {
        super('confirm-modal');
        if (!callbackCancel) {
            callbackCancel = this.close;
        }
        this.content.querySelector('.confirm').addEventListener('click', confirm => {
            form.submit();
        });
        this.content.querySelector('.cancel').addEventListener('click', cancel => {
            callbackCancel();
        });
    }
}
