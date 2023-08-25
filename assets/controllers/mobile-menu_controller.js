import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    isOpen = false;
    mobileMenuButton = document.querySelector('.mobile_menu_btn');
    mobileMenu = document.querySelector('.mobile_menu');

    connect() {
        this.isOpen = false;
    }

    toggle() {
        if (this.isOpen) {
            this.element.classList.remove('active');
            this.mobileMenu.classList.remove('active');
            this.isOpen = false;
        } else {
            this.element.classList.add('active')
            this.mobileMenu.classList.add('active');
            this.isOpen = true;
        }
    }

    open() {
        this.element.classList.remove('active');
        this.mobileMenu.classList.remove('active');
        this.isOpen = true;
    }

    close() {
        this.mobileMenuButton.classList.remove('active');
        this.mobileMenu.classList.remove('active');
        this.isOpen = false;
    }
}