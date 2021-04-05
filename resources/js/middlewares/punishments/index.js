const REDIRECT = 'redirectors';

export default {
	auth: {
		type: REDIRECT,
		data: {
			// the user should be redirected to this route
			routeName: 'login'
		}
	},
	guest: {
		type: REDIRECT,
		data: {
			routeName: 'home'
		}
	},
}