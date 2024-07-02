class Header {
	constructor() {
		this.navigation = document.querySelector('.site-header .main-navigation');

		this.search_form_input = document.querySelector('.site-header form input[type="text"]');
		this.search_btn = document.querySelector('.site-header .search-btn');

		this.menu_btn = this.navigation.querySelector('.menu-toggle');
		this.menu_close_btn = this.navigation.querySelector('.menu-close');
		this.overlay = this.navigation.querySelector('.overlay');

		this.events();
	}

	events() {
		// Toggle desktop search bar
		this.search_btn.addEventListener('click', (e) => {
			const element = e.target.closest('.content-wrapper').querySelector('.search-form');
			element.classList.toggle('active');

			// When active, focus. When unactive, blur.
			setTimeout(() => {
				if (element.classList.contains('active')) {
					this.search_form_input.focus();
				} else {
					this.search_form_input.blur();
				}
			}, 300);
		});

		// Toggle mobile nav
		this.menu_btn.addEventListener('click', (e) => {
			this.openNavigation();
		});

		// Close mobile nav and hide overlay
		this.menu_close_btn.addEventListener('click', (e) => {
			this.closeNavigation();
		});

		// Close mobile nav and hide overlay
		this.overlay.addEventListener('click', (e) => {
			this.closeNavigation();
		});
	}

	openNavigation() {
		this.navigation.classList.add('active');
		document.querySelector('body').classList.add('lock');
	}

	closeNavigation() {
		this.navigation.classList.remove('active');
		document.querySelector('body').classList.remove('lock');
	}
}

new Header();
