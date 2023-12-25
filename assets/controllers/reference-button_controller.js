import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    referenceButtons = document.querySelectorAll(".reference .header");
    initialize()
    {
        super.initialize();
    }

    connect()
    {
        this.referenceButtons.forEach((Button) => {
            Button.addEventListener('click', (e) => {
                Button.parentElement.classList.toggle('active');
                console.log(Button.parentElement);
            });
        });
    }
}