import store from '@/middlewares/store';

export default {
	auth() {
		if ( store.isLoggedIn() ) {
			return true;
		}

		return false;
	},

	guest() {
		if ( store.isLoggedIn() ) {
			return false;
		}

		return true;
	}
}