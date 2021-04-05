import router from '@/routes/web';

export default {
	// Its required to implement run method and dont forget to return next at the end of it 
	run(data, next) {
		// the route that user should be redirected to it
		let route = this.getRouteByName(data.routeName);

		if (route.path == window.location.pathname) {
			return true;
		}
		
		return next({name: data.routeName});
	},
	getRouteByName(name) {
		let target = null;
		
		for ( let route of router.getRoutes() ) {
			target = route.name == name ? route : target;
		}

		if (target == null) {
			console.error(`There is no route with this name ( ${name} ), please check your redirectors`);
		}

		return target;
	}
}