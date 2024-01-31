import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    newBlock = document.querySelector('#news_list');
    newsList = this.newBlock.querySelectorAll('.secondary__data');

    connect() {
        this.newsList.forEach((item) => {
            item.addEventListener('click', this.switchEvent);
        });
    }

    switchEvent(event) {
        let tabs_parent = event.target.closest('.news_patch');
        let active_switch = tabs_parent.querySelector('.secondary__data.active');
        let active_tab = tabs_parent.querySelector('.news_content_view.active');
        let target_tab = tabs_parent.querySelector('#' + event.target.closest('.secondary__data').getAttribute('data-target'));

        if (active_switch) {
            active_switch.classList.remove('active');
        }

        if (active_tab) {
            active_tab.classList.remove('active');
        }

        if (target_tab) {
            target_tab.classList.add('active');
            event.target.classList.add('active');
        }
    }
}