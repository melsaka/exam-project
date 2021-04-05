class Errors {
	constructor() {
		this.stack = {};
	}

	has(error) {
		return this.stack.hasOwnProperty(error);
	}

	any() {
		return Object.keys(this.stack).length > 0;
	}

	get(error) {
		if (this.stack[error]) {
			return this.stack[error][0];
		}
	}

	record(errors) {
		this.stack = errors;
	}

	clear(error) {
		if (error) {
			delete this.stack[error];

			return;
		}

		this.stack = {}
	}
}

export default Errors;
