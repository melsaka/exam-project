import Api from '@/helpers/Api';

class Collection {
	constructor(items = []) {
		this.items = items;
		this.links = {};
		this.meta = {};
	}

	set(items, links = {}, meta = {}) {
		this.items = items;
		
		this.links = links;

		this.meta = meta;
	}

	// obj => {id : 1}
	get(obj) {
		let prop = this.getFirstProp(obj);
		for (let i = 0; i < this.items.length; i++) {
			if (this.items[i][prop] == obj[prop]) {
				return this.items[i];
			}
		}
	}

	all() {
		return this.items;
	}

	add(item) {
		if (Array.isArray(item)) {
			return this.items.unshift(...item);
		}
		
		this.items.unshift(item);
	}

	addToEnd(item) {
		if (Array.isArray(item)) {
			return this.items.push(...item);
		}

		this.items.push(item);
	}

	// obj => {id : 1}
	delete(obj) {
		let prop = this.getFirstProp(obj);
		this.items.forEach((item, index) => {
			item[prop] == obj[prop] ? this.items.splice(index, 1) : false;
		});
	}

	count() {
		return this.items.length;
	}

	any() {
		return this.count() ? true : false;
	}

	empty() {
		return !this.any();
	}

	isNextLink() {
		return this.links ? this.links.next : null;
	}

	loadMore() {
		Api.get(this.links.next)
			.then(response => {
				this.addToEnd(response.data)
				this.links = response.links;
			});
	}

	getFirstProp(obj) {
		return Object.keys(obj)[0];
	}
}

export default Collection;