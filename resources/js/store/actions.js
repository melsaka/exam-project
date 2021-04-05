export default {
	logUserIn: (context, user) => context.commit('logUserIn', user),
	logUserOut: context => context.commit('logUserOut'),
}