import createPersistedState from "vuex-persistedstate";

export default [
	createPersistedState({
		storage: window.sessionStorage,
		paths: ['authenticated', 'user']
	})
];