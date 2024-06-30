class Header {
	constructor() {
		this.navigation = document.querySelector('.site-header .main-navigation');

		this.search_form_input = document.querySelector('.site-header form input[type="text"]');
		this.search_btn = document.querySelector('.site-header .search-btn');
		this.events();
	}

	events() {
		this.search_btn.addEventListener('click', (e) => {
			const element = e.target.closest('.content-wrapper').querySelector('.search-form');
			element.classList.toggle('active');

			setTimeout(() => {
				if (element.classList.contains('active')) {
					this.search_form_input.focus();
				} else {
					this.search_form_input.blur();
				}
			}, 300);
		});
	}
}

new Header();
