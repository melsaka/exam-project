import redirectors from '@/middlewares/punishments/redirectors';
import punishments from '@/middlewares/punishments/index';
import guards from '@/middlewares/guards';

window.redirectors = redirectors;

class Middleware {
	constructor() {
		this.punishments = punishments;
		this.guards = guards;
	}

	/*
	* checks if we have guard for this rule or not 
	* and if so we call it to check the rule validation
	*/
	check(rule) {
		if ( typeof this.guards[rule] == 'function' ) {
			return this.guards[rule]();
		}

		console.error(`There is no guard for this rule (${rule}), please check your middlewares.`);
	}

	/*
	* get the related punishment for this rule and then
	* call it to execute its functionality
	*/
	applyPunishment(rule, next) {
		if ( typeof this.punishments[rule] == 'object' ) {
			let punishment = this.punishments[rule];
			return this.execute(punishment, next);
		}

		console.error(`There is no punishment for this rule (${rule}), please check your middlewares.`);
	}

	execute({type, data}, next) {
		return window[type].run(data, next);
	}
}

export default Middleware;