/**
 * A simple way to cut 'document.getElementById'
 * @param {string} e
 */
function id(e) {
	return document.getElementById(e);
}

var categoriesTitle = document.querySelector('.categories-title');
var accordion = document.getElementsByClassName("accordion");
var menuUl = document.querySelector('#nav-menu ul');
var categoriesButton = id('categories-button');
var categoriesMenu = id('categories-menu');
var menuContainer = id('menu-container');
var loadingTitle = id('loading-title');
var arrowBottom = id('arrow-bottom');
var searchInput = id('search-input');
var categoriesMenuOpened = false;
var target = id("target-image");
var hamburger = id('hamburger');
var navMenu = id('nav-menu');
var loading = id('loading');
var src = id("src-image");
var logo = id('logo');
var opened = false;
var i = void 0;
/**
 * After page has been loaded, it will
 * remove the loading animation
 */
window.onload = function () {
	loading.classList.remove("loading");
	loadingTitle.innerHTML = '';
};

if (searchInput && Number.isInteger(parseInt(searchInput.value))) searchInput.setAttribute('value', '');

/**
 * This function auto updates pictures after selecting them via
 * file input
 * @param {string} src 
 * @param {string} target 
 */
function showImage(src, target) {
	var fr = new FileReader();

	fr.onload = function (e) {
		target.src = this.result;
	};
	src.addEventListener("change", function () {
		return fr.readAsDataURL(src.files[0]);
	});
}

// User on page where variables:
// src and target exist, run function
if (src && target) showImage(src, target);

/**
 * Loop for accordion functionality
 */
if (accordion) {
	for (i = 0; i < accordion.length; i++) {
		accordion[i].addEventListener("click", function () {
			this.classList.toggle("accordion-active");
			var panel = this.nextElementSibling;

			panel.style.maxHeight = panel.style.maxHeight ? null : panel.scrollHeight + "px";
		});
	}
}
/**
 * Event works only if min-width of display is less than 640px
 * @event click
 */
if (window.matchMedia("( min-width: 640px )").matches) {
	categoriesButton.addEventListener('click', function () {

		if (categoriesMenuOpened === false) {
			categoriesMenu.style.display = "block";
			arrowBottom.classList.add('arrow-bottom-rotate');
			categoriesMenuOpened = true;
			setTimeout(function () {
				return categoriesMenu.style.opacity = "1";
			}, 100);
		} else if (categoriesMenuOpened === true) {
			categoriesMenu.style.opacity = "0";
			arrowBottom.classList.remove('arrow-bottom-rotate');
			categoriesMenuOpened = false;
			setTimeout(function () {
				return categoriesMenu.style.display = "none";
			}, 100);
		}
	});
}

/**
 * Opens navigation menu on mobile screens
 * after clicking on 'humburger' button
 * 
 * @event click
 */
hamburger.addEventListener('click', function () {
	navMenu.className = "nav-opened";
	menuContainer.style.opacity = "0";
	logo.className = "logo-opened";
	logo.style.opacity = "1";
	logo.style.display = "block";
	menuUl.style.display = "block";
	opened = true;
});

/**
 * Closing navigation menu on mobile screen
 * after clicking anywhere except our navigation
 * 
 * @event mouseup
 */
window.addEventListener('mouseup', function (e) {
	if (e.target != navMenu && opened === true && e.target.parentNode != navMenu) {
		menuContainer.style.opacity = "0.8";
		navMenu.className = "nav-closed";
		logo.className = "logo-closed";
		menuUl.style.display = "none";
		opened = false;

		if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) logo.style.opacity = "0";
		logo.style.display = "none";
	}
});

/**
 * Hide Navbar into a humburger menu
 * when user scrolls lower than 100 px
 */
window.onscroll = function () {
	if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
		menuContainer.className = "hamburger-menu";
		if (opened === false) logo.style.opacity = "0";
		logo.style.display = "none";
	} else {
		menuContainer.className = "regular-menu";
		if (opened === false) logo.style.opacity = "1";
		logo.style.display = "block";
	}
};

/**
 * Removing word 'Категории' on mobile screen,
 * and put it back on descktop
 */
if (window.matchMedia("( min-width: 640px )").matches) {
	categoriesTitle.innerHTML = 'Категории';
} else {
	categoriesTitle.innerHTML = '';
}