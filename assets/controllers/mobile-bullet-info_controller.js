import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    bulletsInfoButtons = document.querySelectorAll('.mobile_ammo_options .button');

    initialize()
    {
        super.initialize();
    }

    connect() {
        super.connect();

        this.bulletsInfoButtons.forEach((item) => {
            item.addEventListener('click', (e) => this.showMobileInfo(e));
        });
    }

    showMobileInfo(event) {

        const opts_container = event.target.closest('.mobile_ammo_options').querySelector('.options');
        const target = event.target.closest('.button');

        // if (opts_container.classList.contains('active')) {
            opts_container.classList.toggle('active');
            target.classList.toggle('active');
        // } else {
        //     opts_container.classList.toggle('active');
        //     target.classList.toggle('active');
        // }
    }
}