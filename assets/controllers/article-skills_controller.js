import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    tabs = document.querySelectorAll('.select_abils');

    initialize()
    {
        super.initialize();
    }

    connect()
    {
        this.tabs.forEach((item) => {
            item.addEventListener('click', (e) => this.switchSkills(e));
        });
    }

    switchSkills(event)
    {
        let tabs_parent = event.target.closest('.abils');
        let active_switch = tabs_parent.querySelector('.select_abils.active');
        let active_tab = tabs_parent.querySelector('.abil.active');
        let target_tab = tabs_parent.querySelector('#' + event.target.closest('.select_abils').getAttribute('data-tab'));

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