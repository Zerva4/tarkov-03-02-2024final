document.addEventListener('DOMContentLoaded', function () {
	// try {
	// 	let mobile_menu_btn = document.querySelector('.mobile_menu_btn');
	//
	// 	mobile_menu_btn.addEventListener('click', (e) => openMobileMenu(e));
	// }
	// catch { }

	// try {
	// 	let menu_mobile_close = document.querySelector('#menu_mobile_close');
	//
	// 	menu_mobile_close.addEventListener('click', (e) => closeMobileMenu(e));
	// }
	// catch { }

	try {
		let reference_btns = document.querySelectorAll('.reference .header');

		reference_btns.forEach((item) => {
			item.addEventListener('click', (e) => switchReference(e));
		});
	}
	catch { }

	try {
		let tabs = document.querySelectorAll('.switchers');

		tabs.forEach((item) => {
			item.addEventListener('click', (e) => switchTab(e));
		});
	}
	catch { }

	try {
		let tabs = document.querySelectorAll('.main_information .select');

		tabs.forEach((item) => {
			item.addEventListener('click', (e) => switchMainWindow(e));
		});
	}
	catch { }

	try {
		let login = document.getElementById('login');

		login.addEventListener('click', (e) => openLoginModal(e));
	}
	catch { }

	try {
		let login = document.getElementById('login_main');

		login.addEventListener('click', (e) => openLoginModal(e));
	}
	catch { }

	try {
		let closes = document.querySelectorAll('.modal_wrapper .modal .close');

		closes.forEach((item) => {
			item.addEventListener('click', (e) => closeModal(e));
		});

		let wrappers = document.querySelectorAll('.modal_wrapper');

		wrappers.forEach((item) => {
			item.addEventListener('click', (e) => closeModal(e));
		});
	}
	catch { }

	try {
		let auth_btn = document.querySelectorAll('.modal_wrapper .auth_btn');

		auth_btn.forEach((item) => {
			item.addEventListener('click', (e) => switchAuthModal(e));
		});
	}
	catch { }

	try {
		let collapsers = document.querySelectorAll('.mobile_collapser');

		collapsers.forEach((item) => {
			item.addEventListener('click', (e) => switchCraftMobileCollapse(e));
		});
	}
	catch { }

	try {
		let ammo_options_btns = document.querySelectorAll('.mobile_ammo_options .button');

		ammo_options_btns.forEach((item) => {
			item.addEventListener('click', (e) => openMobileAmmoOptions(e));
		});
	}
	catch { }

	try {
		let mobile_ammo_chooser_btn = document.querySelector('.mobile_ammo_chooser_btn');

		mobile_ammo_chooser_btn.addEventListener('click', (e) => openMobileAmmoChooser(e));
	}
	catch { }

	try {
		let bullets = document.querySelectorAll('.bullet_tr');

		bullets.forEach((item) => {
			item.addEventListener('click', (e) => rowClickHandle(e));
		});
	}
	catch { }

	// health-page
	try {
		let buttonsTables = document.querySelectorAll('.button-table');
		buttonsTables.forEach((element) => {
			element.addEventListener('click', (event) => {
				buttonHandler(event);
				element.querySelector('.button-icon').classList.toggle('active');
			})
		})
	}
	catch { }

	try {
		let head = document.querySelector('#part1');
		let breast = document.querySelector('#part2');
		let rightArm = document.querySelector('#part3');
		let abdomen = document.querySelector('#part4');
		let rigthLeg = document.querySelector('#part5');
		let leftLeg = document.querySelector('#part6');
		let leftArm = document.querySelector('#part7');
		let titleChange = document.querySelectorAll('.changeable-title');
		let subTitleFracture = document.querySelectorAll('.changeable-subtitle_fracture');
		let subTitleDestroyed = document.querySelectorAll('.changeable-subtitle_destroyed');
		let subTitleProperties = document.querySelectorAll('.changeable-subtitle_properties');
		leftArm.classList.add('selected_color');
		head.addEventListener('click', (e) => clickHandler(e, titleChange, subTitleFracture, subTitleProperties));
		breast.addEventListener('click', (e) => clickHandler(e, titleChange, subTitleFracture, subTitleProperties));
		rightArm.addEventListener('click', (e) => clickHandler(e, titleChange, subTitleFracture, subTitleProperties));
		abdomen.addEventListener('click', (e) => clickHandler(e, titleChange, subTitleFracture, subTitleProperties));
		rigthLeg.addEventListener('click', (e) => clickHandler(e, titleChange, subTitleFracture, subTitleProperties));
		leftLeg.addEventListener('click', (e) => clickHandler(e, titleChange, subTitleFracture, subTitleProperties));
		leftArm.addEventListener('click', (e) => clickHandler(e, titleChange, subTitleFracture, subTitleProperties));
	}
	catch { }

	// mechanics-page
	try {
		let blockToggle = document.querySelector(".toggle__container");
		let togglePremium = document.querySelector(".toggle");
		let category = document.querySelector(".category");
		let categoryInput = category.querySelector(".color_white");
		let blockCategory = category.querySelector(".element");
		let buttonCategory = category.querySelector(".triangle");
		let listCategory = category.querySelector(".dropdown");
		let categoriesSelected = listCategory.querySelectorAll(".text");
		let blockAuthor = document.querySelector(".author");
		let buttonAuthor = blockAuthor.querySelector(".triangle");
		let listAuthor = blockAuthor.querySelector(".dropdown");
		let authorSelected = listAuthor.querySelectorAll(".text");
		let authorInput = blockAuthor.querySelector(".color_white");
		let containerCards = document.querySelector(".container__cards");
		let containerCardsItems = containerCards.querySelectorAll(".item");
		let levelArmorDamage = document.querySelector(".level__armor_damage");
		let countLevelDamage = 1;
		let templateArmorDamage = document.querySelector(
			"#blockTemplate__armor_damage"
		);

		blockToggle.addEventListener('click', () => {
			togglePremium.classList.toggle("toggle_no_active");
			filterCards(categoryInput, authorInput, togglePremium, containerCardsItems);
		});

		for (let i = 0; i < countLevelDamage; i++) {
			const armorBlockClone = document.importNode(templateArmorDamage.content, true);
			levelArmorDamage.appendChild(armorBlockClone);
		}
		category.addEventListener("mouseleave", () => {
			listCategory.classList.add("dropdown-hidden");
			buttonCategory.classList.remove("active");
		});
		
		blockAuthor.addEventListener("mouseleave", () => {
			listAuthor.classList.add("dropdown-hidden");
			buttonAuthor.classList.remove("active");
		});
		
		blockCategory.addEventListener("click", () => {
			listCategory.classList.toggle("dropdown-hidden");
			buttonCategory.classList.toggle("active");
			blockCategory.classList.toggle("active");
		});
		
		blockAuthor.addEventListener("click", () => {
			listAuthor.classList.toggle("dropdown-hidden");
			buttonAuthor.classList.toggle("active");
			blockAuthor.classList.toggle("active");
		});
		categoriesSelected.forEach((category) => {
			category.addEventListener("click", (evt) => {
				categoryInput.textContent = evt.target.textContent;
				filterCards(categoryInput, authorInput, togglePremium, containerCardsItems);
				listCategory.classList.add("dropdown-hidden");
				buttonCategory.classList.remove("active");
			});
		});
		authorSelected.forEach((author) => {
			author.addEventListener("click", (evt) => {
				authorInput.textContent = evt.target.textContent;
				filterCards(categoryInput, authorInput, togglePremium, containerCardsItems);
			});
		
			listAuthor.classList.add("dropdown-hidden");
			buttonAuthor.classList.remove("active");
		});

	}
	catch { }

});

function switchMainWindow(event) {
	let tabs_parent = event.target.closest('.main_information');
	let active_switch = tabs_parent.querySelector('.select.active');
	let active_tab = tabs_parent.querySelector('.window.active');
	let target_tab = tabs_parent.querySelector('#' + event.target.closest('.select').getAttribute('data-target'));

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

function rowClickHandle(event) {
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

function openMobileAmmoOptions(event) {
	let opts_container = event.target.closest('.mobile_ammo_options').querySelector('.options');
	let target = event.target.closest('.button');

	if (opts_container.classList.contains('active')) {
		opts_container.classList.remove('active');
		target.classList.remove('active');
	}
	else {
		opts_container.classList.add('active');
		target.classList.add('active');
	}
}

function openMobileAmmoChooser(event) {
	let chooser = document.querySelector('.ammo_chooser');

	if (chooser.classList.contains('active')) {
		chooser.classList.remove('active');
		event.target.classList.remove('active');
	}
	else {
		chooser.classList.add('active');
		event.target.classList.add('active');
	}
}

function switchAuthModal(event) {
	let id = event.target.getAttribute('data-id');

	if (id) {
		let active = document.querySelector('.modal_wrapper .contain.active');
		active.classList.remove('active');
		document.getElementById(id).classList.add('active');

		if (id === 'modal_contain_main') {
			let prev = document.querySelector('.prev.auth_btn');

			if (prev.classList.contains('active')) {
				prev.classList.remove('active');
			}
		}
		else {
			let prev = document.querySelector('.prev.auth_btn');

			if (!prev.classList.contains('active')) {
				prev.classList.add('active');
			}
		}

		if (id === 'modal_contain_restore_email' || id === 'modal_contain_restore_password') {
			event.target.closest('.modal').querySelector('.restore_form').classList.add('active');
		}
		else {
			event.target.closest('.modal').querySelector('.restore_form').classList.remove('active');
		}
	}

}

function openLoginModal(event) {
	let login = document.getElementById('login_modal');

	login.classList.add('active');
}

function closeModal(event) {
	let modal = event.target.closest('.modal_wrapper');

	if (event.target.classList.contains('modal_wrapper') ||
		event.target.classList.contains('close')) {
		modal.classList.remove('active');
	}
}

function switchTab(event) {
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

function openMobileMenu(event) {
	let mobile_menu = document.querySelector('.mobile_menu');

	event.target.classList.add('active');
	mobile_menu.classList.add('active');
}

function closeMobileMenu(event) {
	let mobile_menu = document.querySelector('.mobile_menu');
	let mobile_menu_btn = document.querySelector('.mobile_menu_btn');

	mobile_menu.classList.remove('active');
	mobile_menu_btn.classList.remove('active');
}

function switchReference(event) {
	let reference = event.target.closest('.reference');

	if (reference.classList.contains('active')) {
		reference.classList.remove('active');
	}
	else {
		reference.classList.add('active');
	}
}

function switchCraftMobileCollapse(event) {
	let target = event.target.closest('.mobile_collapser');
	let parent = event.target.closest('.mobile_collapser_parent');
	let wrapper = parent.querySelector('.wrapper');

	if (target.classList.contains('active')) {
		target.classList.remove('active');
		wrapper.classList.remove('active');
	}
	else {
		target.classList.add('active');
		wrapper.classList.add('active');
	}
}

// health-page

function buttonHandler(event) {
	let tableMobile = event.target.closest('.table-mobile').querySelector('.subtitle');
	tableMobile.classList.toggle('hidden');
}

function openModalHealth() {
	let popupHealth = document.querySelector('.popupHealth');
	let buttonClose = popupHealth.querySelector('.button-close');
	popupHealth.classList.add('active');
	buttonClose.addEventListener('click', () => closeModalHealth(popupHealth));
}

function closeModalHealth(popup) {
	popup.classList.remove('active');
}

function clickHandler(event, titleChange, subTitleFracture, subTitleProperties) {
	let selected = document.querySelector('.selected_color');
	if(selected) {
		selected.classList.remove('selected_color');
	}
	event.target.classList.add('selected_color');
	infoBodyParts.forEach((item) => {
		if(item.id === event.target.id) {
			titleChange.forEach((elem) => {
        elem.textContent = item.name
      });
			subTitleFracture.forEach((elem) => {
        elem.textContent = item.fracture
      });
      subTitleProperties.forEach((elem) => {
        elem.textContent = item.properties
      });
		}
	})
	openModalHealth();
}

const infoBodyParts = [
  {
    id: 'part1',
    name: 'Голова',
    fracture: 'Что-то с переломом головы',
    destroyed: 'Уничтожение головы',
    properties: 'Особенности головы',
  },
  {
    id: 'part2',
    name: 'Грудная клетка',
    fracture: 'Что-то с переломом грудной клетки',
    destroyed: 'Уничтожение грудной клетки',
    properties: 'Особенности грудной клетки',
  },
  {
    id: 'part3',
    name: 'Рука (правая)',
    fracture: 'Что-то с переломом правой руки',
    destroyed: 'Уничтожение правой руки',
    properties: 'Особенности правой руки',
  },
  {
    id: 'part4',
    name: 'Полость живота',
    fracture: 'Что-то с ударом в полость живота',
    destroyed: 'Уничтожение полости живота',
    properties: 'Особенности полости живота',
  },
  {
    id: 'part5',
    name: 'Нога (правая)',
    fracture: 'Что-то с переломом правой ноги',
    destroyed: 'Уничтожение правой ноги',
    properties: 'Особенности правой ноги',
  },
  {
    id: 'part6',
    name: 'Нога (левая)',
    fracture: 'Что-то с переломом левой ноги',
    destroyed: 'Уничтожение левой ноги',
    properties: 'Особенности левой ноги',
  },
  {
    id: 'part7',
    name: 'Рука (левая)',
    fracture: 'Что-то с переломом левой руки',
    destroyed: 'Уничтожение левой руки',
    properties: 'Особенности левой руки',
  }
]

//mechanics-page
function filterCards(categoryInput, authorInput, togglePremium, containerCardsItems) {
	let selectedTheme = categoryInput.textContent;
  let selectedAuthor = authorInput.textContent;
  let isPremiumChecked = togglePremium.classList.contains('toggle_no_active') ? 'false' : 'true';
  containerCardsItems.forEach(item => {
    let theme = item.getAttribute('data-theme');
    let author = item.getAttribute("data-author");
    let isPremium = item.getAttribute("data-premium");
    let themeMatch = selectedTheme === theme;
    let authorMatch = selectedAuthor === author;
    let premiumMatch = isPremiumChecked === isPremium;
    item.style.display = themeMatch && authorMatch && premiumMatch ? "block" : "none";
  })
}