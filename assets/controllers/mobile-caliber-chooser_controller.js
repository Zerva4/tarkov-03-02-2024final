import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    mobileCaliberChooser = document.querySelector('.mobile_ammo_chooser_btn');

    initialize()
    {
        super.initialize();
    }

    connect() {
        super.connect();

        this.mobileCaliberChooser.addEventListener('click', (e) => this.caliberChooser(e));
    }

    caliberChooser(event) {
        let chooser = document.querySelector('.ammo_chooser');

        if (chooser.classList.contains('active')) {
            chooser.classList.remove('active');
            event.target.classList.remove('active');
        } else {
            chooser.classList.add('active');
            event.target.classList.add('active');
        }
    }
}