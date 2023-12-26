import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    bullets = document.querySelectorAll('.bullet_tr');

    initialize()
    {
        super.initialize();
    }

    connect() {
        super.connect();

        this.bullets.forEach((item) => {
            item.addEventListener('click', (e) => this.showInfo(e));
        });
    }

    showInfo(event) {
        let target = event.target.closest('.bullet_tr');
        let prem = target.nextElementSibling;

        if (!target.classList.contains('active')) {
            prem.classList.add('active');
            target.classList.add('active');
        }
        else {
            prem.classList.remove('active');
            target.classList.remove('active');
        }
    }
}