class OAuthPopup {
	constructor(clientName, clientId, authUrl, tokenUrl, redirectUri, scope) {
		this.clientName = clientName;
		this.clientId = clientId;
		this.authUrl = authUrl;
		this.tokenUrl = tokenUrl;
		this.redirectUri = redirectUri;
		this.scope = scope;
		this.popup = null;
	}

	generateRandomString(length) {
		const array = new Uint32Array(length);
		window.crypto.getRandomValues(array);
		return Array.from(array, (dec) => ("0" + dec.toString(16)).slice(-2)).join(
			""
		);
	}

	login() {
		const state = this.generateRandomString(16);

		const authParams = new URLSearchParams({
			client_name: this.clientName,
			client_id: this.clientId,
			redirect_uri: this.redirectUri,
			scope: this.scope,
			response_type: "code",
			state: state,
		});

		const authWindowUrl = `${this.authUrl}?${authParams.toString()}`;

		this.popup = window.open(
			authWindowUrl,
			"oauthPopup",
			"width=520,height=800"
		);

		return new Promise((resolve, reject) => {
			const interval = setInterval(() => {
				if (this.popup.closed) {
					clearInterval(interval);
					reject(new Error("Popup closed by user"));
				}

				try {
					const popupUrl = new URL(this.popup.location.href);
					if (
						popupUrl.origin === window.location.origin &&
						popupUrl.pathname === new URL(this.redirectUri).pathname
					) {
						const code = popupUrl.searchParams.get("code");
						const stateReturned = popupUrl.searchParams.get("state");

						if (state !== stateReturned) {
							reject(new Error("Invalid state"));
						}

						this.popup.close();
						clearInterval(interval);

						this.exchangeCodeForToken(code).then(resolve).catch(reject);
					}
				} catch (e) {
					// Ignore cross-origin errors
				}
			}, 100);
		});
	}

	async exchangeCodeForToken(code) {
		const response = await fetch(`${this.tokenUrl}`, {
			method: "POST",
			headers: {
				apiKey: "0194cb1f-fa3f-7dc3-a78e-85bf30f85ddf",
				"Content-Type": "application/json",
			},
			body: JSON.stringify({
				code: code,
			}),
		});

		if (!response.ok) {
			throw new Error("Token exchange failed");
		}

		return response.json();
	}
}

// Contoh penggunaan:
// const oauth = new OAuthPopup(
//     'SimpunASN',
//     '0194cb1f-fa3f-7dc3-a78e-85bf30f85ddf',
//     'https://silka-sso.vercel.app/oauth/sso/authorize',
//     'http://silka.balangankab.go.id/services/v2/oauth/sso/access_token',
//     'http://localhost:8000/oauth/sso/callback',
//     'userportal'
// );
// document.getElementById('loginButton').addEventListener('click', () => {
//     oauth.login().then((tokenResponse) => {
//         console.log('Access Token:', tokenResponse.access_token);
//     }).catch((error) => {
//         console.error('Login failed:', error);
//     });
// });
