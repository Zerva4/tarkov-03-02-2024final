document.addEventListener('DOMContentLoaded', function () {
//	try {
//		let mobile_menu_btn = document.querySelector('.mobile_menu_btn');
//		mobile_menu_btn.addEventListener('click', (e) => openMobileMenu(e));
//	}
//	catch { }
//
//	try {
//		let menu_mobile_close = document.querySelector('#menu_mobile_close');
//		menu_mobile_close.addEventListener('click', (e) => closeMobileMenu(e));
//	}
//	catch { }

	// try {
	// 	let reference_btns = document.querySelectorAll('.reference .header');
	// 	reference_btns.forEach((item) => {
	// 		item.addEventListener('click', (e) => switchReference(e));
	// 	});
	// }
	// catch { }

	try {
		let collapse_btns = document.querySelectorAll('.collapse-box .collapse-box__title');
		collapse_btns.forEach((item) => {
			item.addEventListener('click', (e) => switchCollapse(e));
		});
	}
	catch { }

	try {
		const auhorized_profile_avatar = document.querySelector('.auhorized_profile_avatar');
		auhorized_profile_avatar.addEventListener('click', openProfileMenu);
	}
	catch { }

	document.addEventListener('click', closeProfileMenu);

	// try {
	// 	let tabs = document.querySelectorAll('.switchers');
	//
	// 	tabs.forEach((item) => {
	// 		item.addEventListener('click', (e) => switchTab(e));
	// 	});
	// }
	// catch { }

	try {
		let tabs = document.querySelectorAll('.select_abils');

		tabs.forEach((item) => {
			item.addEventListener('click',switchSkills);
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

		login.addEventListener('click', openLoginModal);
	}
	catch { }

	try {
		let login = document.getElementById('login_main');

		login.addEventListener('click', openLoginModal);
	}
	catch { }

	try {
		let login = document.getElementById('mobile_login');

		login.addEventListener('click', openLoginModal);
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

	try {
		let calibers = document.querySelectorAll('.ammo_chooser .ammo');

		calibers.forEach((item) => {
			item.addEventListener('click', (e) => openCaliber(e));
		});
	}
	catch { }

	// news-page

	try {
		let news__secondary_mobile_patch = document.querySelector('.news__secondary_mobile_patch');

		news__secondary_mobile_patch.addEventListener('click', (e) => openMobileNewsPatch(e));
	}
	catch { }

	try {
		let news__secondary_mobile_event = document.querySelector('.news__secondary_mobile_event');

		news__secondary_mobile_event.addEventListener('click', (e) => openMobileNewsEvent(e));
	}
	catch { }

	try {
		let news__secondary_mobile_site = document.querySelector('.news__secondary_mobile_site');

		news__secondary_mobile_site.addEventListener('click', (e) => openMobileNewsSite(e));
	}
	catch { }

	try {
		let tabs = document.querySelectorAll('.news_patch .secondary__data');

		tabs.forEach((item) => {
			item.addEventListener('click', switchPatch);
		});
	}
	catch { }

	try {
		let tabs = document.querySelectorAll('.news_event .secondary__data');

		tabs.forEach((item) => {
			item.addEventListener('click', switchEvent);
		});
	}
	catch { }

	try {
		let tabs = document.querySelectorAll('.news_site .secondary__data');

		tabs.forEach((item) => {
			item.addEventListener('click', switchSite);
		});
	}
	catch { }

	try {
		let tabs = document.querySelectorAll('.section_body .news_list__element');

		tabs.forEach((item) => {
			item.addEventListener('click', switchNews);
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

		const urlParams = new URLSearchParams(window.location.search);
		const categoryUrl = urlParams.get("category");
		const author = urlParams.get("author");
		const premium = urlParams.get("premium");

		categoryInput.textContent = categoryUrl || "Все";
		authorInput.textContent = author || "Все";
		if (premium === "true") {
			togglePremium.classList.remove("toggle_no_active");
		} else if (premium === "false") {
			togglePremium.classList.add("toggle_no_active");
		}

		filterCards(categoryInput, authorInput, togglePremium, containerCardsItems);

		blockToggle.addEventListener("click", () => {
			togglePremium.classList.toggle("toggle_no_active");
			updateFilters(categoryInput, authorInput, togglePremium);
		});

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

				listCategory.classList.add("dropdown-hidden");
				buttonCategory.classList.remove("active");
				updateFilters(categoryInput, authorInput, togglePremium);
			});
		});
		authorSelected.forEach((author) => {
			author.addEventListener("click", (evt) => {
				authorInput.textContent = evt.target.textContent;
				updateFilters(categoryInput, authorInput, togglePremium);
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

const fadeIn = (el, timeout, display) => {
	el.style.opacity = 0;
	el.style.display = display || 'block';
	el.style.transition = `opacity ${timeout}ms`;
	setTimeout(() => {
		el.style.opacity = 1;
	}, 10);
};

const fadeOut = (el, timeout) => {
	el.style.opacity = 1;
	el.style.transition = `opacity ${timeout}ms`;
	el.style.opacity = 0;

	setTimeout(() => {
		el.style.display = 'none';
	}, timeout);
};

function openProfileMenu(event) {
	let chooser = document.querySelector('.auhorized_menu_open');
	event.stopPropagation()
	if (chooser.classList.contains('active')) {
		fadeOut (chooser, 250);
	} else {
		fadeIn (chooser, 250);
	};
	chooser.classList.toggle('active');
}


function closeProfileMenu(event) {

	if (!event.target.matches('.auhorized_profile_avatar')) {
		var dropdowns = document.getElementsByClassName("auhorized_menu_open");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('active')) {
				openDropdown.classList.remove('active');
				fadeOut (openDropdown, 250);
			}
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

function switchSkills(event) {
	let tabs_parent = this.closest('.abils');
	let active_switch = tabs_parent.querySelector('.select_abils.active');
	let active_tab = tabs_parent.querySelector('.abil.active');
	let target_tab = tabs_parent.querySelector('#' + this.getAttribute('data-abil'));

	if (active_switch) {
		active_switch.classList.remove('active');
	}

	if (active_tab) {
		active_tab.classList.remove('active');
	}

	this.classList.add('active');
	target_tab.classList.add('active');
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

function switchCollapse(event) {
	let collapse = event.target.closest('.collapse-box__trigger');

	if (collapse.classList.contains('active')) {
		collapse.classList.remove('active');
	}
	else {
		collapse.classList.add('active');
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
function filterCards(
	categoryInput,
	authorInput,
	togglePremium,
	containerCardsItems
) {
	let selectedTheme = categoryInput.textContent;
	let selectedAuthor = authorInput.textContent;
	let isPremiumChecked = togglePremium.classList.contains("toggle_no_active")
		? "false"
		: "true";

	containerCardsItems.forEach((item) => {
		let themes = item.getAttribute("data-theme");
		let themeList = themes ? themes.split(",") : [];
		let author = item.getAttribute("data-author");
		let authorList = author ? author.split(",") : [];
		let isPremium = item.getAttribute("data-premium");

		let themeMatch =
			selectedTheme === "Все" || themeList.includes(selectedTheme);
		let authorMatch =
			selectedAuthor === "Все" || authorList.includes(selectedAuthor);
		let premiumMatch =
			isPremiumChecked === isPremium ||
			(isPremiumChecked === "false" && !isPremium);

		item.style.display =
			themeMatch && authorMatch && premiumMatch ? "block" : "none";
	});

	document.querySelector(".container__cards").style.opacity = 1;
}

function updateFilters(categoryInput, authorInput, togglePremium) {
	const category = categoryInput.textContent;
	const author = authorInput.textContent;
	const isPremium = togglePremium.classList.contains("toggle_no_active")
		? "false"
		: "true";

	const urlParams = new URLSearchParams(window.location.search);
	urlParams.set("category", category);
	urlParams.set("author", author);
	urlParams.set("premium", isPremium);
	window.location.search = urlParams.toString();
}

//news-page

function openMobileNewsPatch(event) {
	let chooser = document.querySelector('.secondary__list_patch');

	if (chooser.classList.contains('active')) {
		chooser.classList.remove('active');
		event.target.classList.remove('active');
	}
	else {
		chooser.classList.add('active');
		event.target.classList.add('active');
	}
}

function openMobileNewsEvent(event) {
	let chooser = document.querySelector('.secondary__list_event');

	if (chooser.classList.contains('active')) {
		chooser.classList.remove('active');
		event.target.classList.remove('active');
	}
	else {
		chooser.classList.add('active');
		event.target.classList.add('active');
	}
}

function openMobileNewsSite(event) {
	let chooser = document.querySelector('.secondary__list_site');

	if (chooser.classList.contains('active')) {
		chooser.classList.remove('active');
		event.target.classList.remove('active');
	}
	else {
		chooser.classList.add('active');
		event.target.classList.add('active');
	}
}

function switchPatch(event) {
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

function switchEvent(event) {
	let tabs_parent = event.target.closest('.news_event');
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

function switchSite(event) {
	let tabs_parent = event.target.closest('.news_site');
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

function switchNews(event) {
	let tabs_parent = event.target.closest('.section_body');
	let active_switch = tabs_parent.querySelector('.section_view.active');
	let active_tab = tabs_parent.querySelector('.news_list__element.active');
	let target_tab = tabs_parent.querySelector('#' + event.target.closest('.news_list__element').getAttribute('data-target'));

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

function openCaliber(event) {
	let target = event.target;
	let caliber = target.innerText;
	let container = document.querySelector(`[data-caliber*="${caliber}"]`);

	if (target) {
		document.querySelector('.ammo_chooser .ammo.active').classList.remove('active');
		target.classList.add('active');

		if (container) {
			document.querySelector('.caliber.active').classList.remove('active');
			container.classList.add('active');
		}
		else {
			container = document.querySelector(`[data-caliber*="no_data"]`);
			document.querySelector('.caliber.active').classList.remove('active');
			container.classList.add('active');
		}
	}
}