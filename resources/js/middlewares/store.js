import store from '@/store/index';

export default {
	isLoggedIn() {
		return store.getters.isLoggedIn;
	}
}