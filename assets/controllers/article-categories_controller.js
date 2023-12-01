import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    category = document.querySelector(".category");
    blockCategory = this.category.querySelector(".element");
    buttonCategory = this.category.querySelector(".triangle");
    listCategory = this.category.querySelector(".dropdown");
    categoryInput = this.category.querySelector(".color_white");
    categoryUrl = '';
    categoriesSelected = this.listCategory.querySelectorAll(".text");

    connect() {
        const path = window.location.pathname.split('mechanics/', 2);

        if (path.length > 1) {
            this.categoryUrl = this.findCurrentCategory(path[1])
            this.categoryInput.textContent = this.findCurrentCategory(path[1]);
        } else {
            this.categoryInput.textContent = "Все"
        }

        this.category.addEventListener("mouseleave", () => {
            this.listCategory.classList.add("dropdown-hidden");
            this.buttonCategory.classList.remove("active");
        });

        this.blockCategory.addEventListener("click", () => {
            this.listCategory.classList.toggle("dropdown-hidden");
            this.buttonCategory.classList.toggle("active");
            this.blockCategory.classList.toggle("active");
        });

        this.categoriesSelected.forEach((category) => {
            category.addEventListener("click", (evt) => {
                this.categoryInput.textContent = evt.target.textContent;

                this.listCategory.classList.add("dropdown-hidden");
                this.buttonCategory.classList.remove("active");
                this.updateFilters(evt.target.dataset.slug);
            });
        });
    }

    initialize() {
        super.initialize();


    }

    findCurrentCategory(slug)
    {
        let result = "Bce"
        this.categoriesSelected.forEach((category) => {
            if (category.dataset.slug === slug) {
                result = category.textContent;
            }
        });

        return result;
    }

    updateFilters(slugCategory)
    {
        window.location = '/mechanics/' + slugCategory;
    }
}