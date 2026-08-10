function Logout() {
	iziToast.question({
		timeout: 20000,
		close: false,
		overlay: true,
		displayMode: "once",
		id: "question",
		zindex: 999,
		title: "Logout ?",
		message: "Apakah anda yakin akan keluar dari aplikasi ?",
		position: "bottomCenter",
		buttons: [
			[
				"<button><b>YES</b></button>",
				function (instance, toast) {
					instance.hide({ transitionOut: "fadeOut" }, toast, "button");
					window.location.replace(`${_uri}/oauth/sso/logout`);
				},
				true,
			],
			[
				"<button>NO</button>",
				function (instance, toast) {
					instance.hide({ transitionOut: "fadeOut" }, toast, "button");
				},
			],
		],
	});
}
