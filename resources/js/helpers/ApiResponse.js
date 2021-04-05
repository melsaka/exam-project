class ApiResponse {
	constructor() {
		this.selections	= ['only', 'except'];
		this.status 	= 200;
		this.data		= [];
		this.links		= {};
		this.meta 		= {};
	}

	select(selections) {
		let method = this.getFirstProp(selections);

		return this.selections.includes(method) ? this.dataSeclectionFilter(method, selections) : this;
	}

	dataSeclectionFilter(method, selections) {
		if (this.isCollection()) {
			return this.collectionSelection(method, selections)
		}

		return this[method](this.data, selections);
	}

	collectionSelection(method, selections) {
		return this.data.map(resource => {
			return this[method](resource, selections);
		});	
	}

	only(resource, selections) {
		let only = {};

		selections.only.forEach(element => only[element] = resource[element]);

		return only;
	}

	except(resource, selections) {
		selections.except.forEach(element => delete resource[element]);

		return resource;
	}

	getFirstProp(obj) {
		return Object.keys(obj)[0];
	}

	isCollection() {
		if (this.data) {
			return Array.isArray(this.data);
		}

		return false;
	}
}

export default ApiResponse;