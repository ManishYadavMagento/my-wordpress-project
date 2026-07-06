document.addEventListener("DOMContentLoaded", function () {
	var toggle = document.querySelector("[data-nav-toggle]");
	var mobileMenu = document.getElementById("mobile-menu");
	var stickyHeader = document.querySelector("[data-sticky-header]");
	var slider = document.querySelector("[data-slider]");

	if (toggle && mobileMenu) {
		var closeMenu = function () {
			mobileMenu.classList.remove("is-open");
			toggle.setAttribute("aria-expanded", "false");
		};

		toggle.addEventListener("click", function () {
			var isOpen = mobileMenu.classList.toggle("is-open");
			toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
		});

		mobileMenu.querySelectorAll("a").forEach(function (link) {
			link.addEventListener("click", function () {
				closeMenu();
			});
		});

		document.addEventListener("keydown", function (event) {
			if (event.key === "Escape") {
				closeMenu();
			}
		});
	}

	if (stickyHeader) {
		var syncStickyState = function () {
			if (window.scrollY > 16) {
				stickyHeader.classList.add("is-scrolled");
			} else {
				stickyHeader.classList.remove("is-scrolled");
			}
		};

		syncStickyState();
		window.addEventListener("scroll", syncStickyState, { passive: true });
	}

	if (slider) {
		var slides = Array.prototype.slice.call(slider.querySelectorAll("[data-slide]"));
		var dots = Array.prototype.slice.call(slider.querySelectorAll("[data-slide-to]"));
		var activeIndex = 0;
		var autoplayId = null;

		var showSlide = function (index) {
			slides.forEach(function (slide, slideIndex) {
				slide.classList.toggle("is-active", slideIndex === index);
			});

			dots.forEach(function (dot, dotIndex) {
				dot.classList.toggle("is-active", dotIndex === index);
			});

			activeIndex = index;
		};

		var startAutoplay = function () {
			if (slides.length < 2) {
				slider.classList.add("is-static");
				return;
			}

			autoplayId = window.setInterval(function () {
				var nextIndex = (activeIndex + 1) % slides.length;
				showSlide(nextIndex);
			}, 5000);
		};

		dots.forEach(function (dot) {
			dot.addEventListener("click", function () {
				var targetIndex = parseInt(dot.getAttribute("data-slide-to"), 10);
				if (!Number.isNaN(targetIndex)) {
					showSlide(targetIndex);
				}

				if (autoplayId) {
					window.clearInterval(autoplayId);
					startAutoplay();
				}
			});
		});

		showSlide(0);
		startAutoplay();
	}

	document.querySelectorAll('a[href*="#"]').forEach(function (anchor) {
		anchor.addEventListener("click", function (event) {
			var href = anchor.getAttribute("href");
			if (!href) {
				return;
			}

			var parsedUrl;
			try {
				parsedUrl = new URL(anchor.href, window.location.href);
			} catch (error) {
				return;
			}

			if (parsedUrl.pathname !== window.location.pathname || !parsedUrl.hash) {
				return;
			}

			var target = document.querySelector(parsedUrl.hash);
			if (!target) {
				return;
			}

			event.preventDefault();
			target.scrollIntoView({
				behavior: "smooth",
				block: "start"
			});
		});
	});
});
