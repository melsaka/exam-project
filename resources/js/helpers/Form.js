import Errors from './Errors';
import Api from './Api';

class Form {
	constructor(data) {
		this.data = data;
		this.errors = new Errors();
	}

	assign(data) {
		this.data = data;
	}

	set(attribue, value) {
		this.data[attribue] = value;
	}

	get(attribue) {
		return this.data[attribue];
	}

	reset() {
		for (let property in this.data) {
			if (this.isInteger(this.data[property])) {
				this.data[property] = 0;
				continue;
			}

			this.data[property] = '';
		}

		this.errors.clear();
	}

	post(uri) { 
		return this.submit('post', uri, true);
	}

	patch(uri) {
		return this.submit('patch', uri, false);
	}

	submit(requestType, uri, reset) {
		return new Promise((resolve, reject) => {
			Api[requestType](uri, this.data)
				.then(response => {
					reset ? this.reset() : '';
					resolve(response);
				})
				.catch(response => {
					this.errors.record(response.response.data.errors);
					reject(response);
				});
		});
	}

	isInteger(data) {
		return Number.isInteger(data);
	}
}

export default Form;