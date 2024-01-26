import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    tabs = document.querySelectorAll('.switchers');

    initialize()
    {
        super.initialize();
    }

    connect()
    {
        this.tabs.forEach((item) => {
            item.addEventListener('click', (e) => this.switchTab(e));
        });
    }

    switchTab(event)
    {
        let tabs_parent = event.target.closest('.tabs');
        let active_switch = tabs_parent.querySelector('.switcher.active');
        let active_tab = tabs_parent.querySelector('.tab.active');
        let target_tab = tabs_parent.querySelector('#' + event.target.closest('.switcher').getAttribute('data-tab'));

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