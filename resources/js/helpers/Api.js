import ApiResponse from './ApiResponse';

class Api {
	constructor() {
		this.response = new ApiResponse();
		this.errors = {};
	}

	get(uri) {
		return new Promise((resolve, reject) => {
			this.request('get', uri)
				.then(response => {
					resolve(response);
				})
				.catch(response => {
					reject(response);
				});
		});
	}

	post(uri, data) {
		return this.request('post', uri, data);
	}

	patch(uri, data) {
		return this.request('patch', uri, data);
	}

	delete(uri) {
		return this.request('delete', uri);
	}

	request(type, uri, data = {}) {
		return new Promise((resolve, reject) => {
			axios[type](uri, data)
				.then(response => {
					if (response.status == 204) {
						return resolve(response);
					}

					this.response.status 	= response.status;
					this.response.links 	= response.data.links;
					this.response.meta 		= response.data.meta;
					this.response.data 		= this.handle(response.data);

					resolve(this.response);
				})
				.catch(response => {
					this.errors = response;

					reject(this.errors);
				});
		});
	}

	handle(response) {
		if (this.isCollection(response)) {
			return this.collectionHandler(response.data);
		}

		return this.resourceHandler(response.data);
	}

	collectionHandler(collection) {
		return collection.map(resource => {
			return this.resourceHandler(resource);
        });
	}

	resourceHandler(resource) {
		let relationships = {};
		let data = resource.attributes;
		data.id = resource.id;
		
		if (resource.hasOwnProperty('relationships')) {
			relationships = this.relationshipsHandler(resource.relationships);
			data = this.mergeDataWithRelationships(data, relationships);
		}

		return data;
	}

	relationshipsHandler(relationships) {
		let data = {};

		for (let property in relationships) {
			let RelationResponse 	= new ApiResponse;
			RelationResponse.meta 	= relationships[property].meta;
			RelationResponse.links	= relationships[property].links;
			RelationResponse.data 	= this.handle(relationships[property]);
			data[property] 			= RelationResponse;
		}

		return data;
	}

	mergeDataWithRelationships(data, relationships) {
		for (let property in relationships) {
			data[property] = relationships[property];
		}

		return data;
	}

	isCollection(response) {
		if (response) {
			return Array.isArray(response.data);
		}

		return false;
	}
}

export default new Api;