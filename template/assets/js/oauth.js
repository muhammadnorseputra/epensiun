class Oauth {
	constructor(buttonId, options = {}) {
		this.button = document.getElementById(buttonId);

		if (!this.button) {
			throw new Error(`Button #${buttonId} tidak ditemukan`);
		}

		this.config = {
			url: "/oauth/sso/authorize",
			redirect: "/",
			width: 500,
			height: 700,
			buttonText: this.button.innerHTML,
			loadingHtml:
				'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>',
			successHtml: '<i class="bi bi-check-circle-fill text-success"></i>',
			onSuccess: null,
			onFailed: null,
			...options,
		};

		this.loading = false;
		this.popupWindow = null;
		this.popupChecker = null;

		this.handleClick = this.handleClick.bind(this);
		this.handleMessage = this.handleMessage.bind(this);

		this.init();
	}

	init() {
		this.button.addEventListener("click", this.handleClick);
		window.addEventListener("message", this.handleMessage);
	}

	destroy() {
		this.button.removeEventListener("click", this.handleClick);
		window.removeEventListener("message", this.handleMessage);

		if (this.popupChecker) {
			clearInterval(this.popupChecker);
		}
	}

	setLoading(state) {
		this.loading = state;

		if (state) {
			this.button.disabled = true;
			this.button.innerHTML = this.config.loadingHtml;
		} else {
			this.button.disabled = false;
			this.button.innerHTML = this.config.buttonText;
		}
	}

	openPopup() {
		const left = window.screenX + (window.outerWidth - this.config.width) / 2;

		const top = window.screenY + (window.outerHeight - this.config.height) / 2;

		this.popupWindow = window.open(
			this.config.url,
			"SSOLogin",
			`
            width=${this.config.width},
            height=${this.config.height},
            left=${left},
            top=${top},
            popup=yes,
            resizable=no,
            scrollbars=yes
            `,
		);

		return this.popupWindow;
	}

	watchPopup() {
		this.popupChecker = setInterval(() => {
			if (!this.popupWindow) return;

			if (this.popupWindow.closed) {
				clearInterval(this.popupChecker);

				if (this.loading) {
					this.setLoading(false);

					console.log("Login dibatalkan");
				}
			}
		}, 500);
	}

	handleClick() {
		if (this.loading) return;

		this.setLoading(true);

		const popup = this.openPopup();

		if (!popup) {
			alert("Popup blocked");

			this.setLoading(false);

			return;
		}

		popup.focus();

		this.watchPopup();
	}

	handleMessage(event) {
		if (!event.data || !event.data.type) {
			return;
		}

		switch (event.data.type) {
			case "SSO_SUCCESS":
				this.button.innerHTML = this.config.successHtml;

				if (this.popupWindow && !this.popupWindow.closed) {
					this.popupWindow.close();
				}

				if (typeof this.config.onSuccess === "function") {
					this.config.onSuccess(event.data);
				} else {
					setTimeout(() => {
						window.location.href = this.config.redirect;
					}, 1000);
				}

				break;

			case "SSO_FAILED":
				this.setLoading(false);

				if (this.popupWindow && !this.popupWindow.closed) {
					this.popupWindow.close();
				}

				if (typeof this.config.onFailed === "function") {
					this.config.onFailed(event.data);
				} else {
					alert(event.data.response || "Login gagal");
				}

				break;
		}
	}
}

window.Oauth = Oauth;
