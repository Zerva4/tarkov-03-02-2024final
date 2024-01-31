import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    tabs = document.querySelectorAll('.selects');

    initialize()
    {
        super.initialize();
    }

    connect()
    {
        this.tabs.forEach((item) => {
            item.addEventListener('click', (e) => this.switchWindows(e));
        });
    }

    switchWindows(event)
    {
        let tabs_parent = event.target.closest('.main_information');
        let active_switch = tabs_parent.querySelector('.select.active');
        let active_tab = tabs_parent.querySelector('.window.active');
        let target_tab = tabs_parent.querySelector('#' + event.target.closest('.select').getAttribute('data-tab'));

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