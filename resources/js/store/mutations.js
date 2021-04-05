export default {
	logUserIn: (state, user) => { 
		state.authenticated = true;
		state.user = user.attributes;
		state.user.id = user.id;
	},
	logUserOut: state => {
		state.authenticated = false;
		state.user = {};
	}
}