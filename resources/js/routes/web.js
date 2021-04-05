import auth from './modules/auth';
import exams from './modules/exams';
import errors from './modules/errors';
import subjects from './modules/subjects';
import questions from './modules/questions';
import Middleware from '@/middlewares/index';
import Settings from '@/views/Settings';
import VueRouter from 'vue-router';
import Home from '@/views/Home';

const routes = [
	...auth,
	...subjects,
	...exams,
	...questions,
	...errors,
	{
		path: '/settings',
		name: 'settings',
		component: Settings,
		meta: {
			middlewares: ['auth']
		}
	},
	{
		path: '/',
		name: 'home',
		component: Home,
		meta: {
			// middleware rules
			middlewares: ['auth']
		}
	},
	{ 
		path: '/:pathMatch(.*)*', 
		redirect: '/404' 
	}
];

const router = new VueRouter({
	mode: 'history',
	base: process.env.APP_URL,
	routes
});

const middleware = new Middleware();

router.beforeEach((to, from, next) => {

	let rules = to.meta.hasOwnProperty('middlewares') ? to.meta.middlewares : [];

	for (let rule of rules) {
		// check if we have a guard for this rule and if so we call it to check the rule validation
		let validation = middleware.check(rule);
		// if the user didn't meet rule requirements then we punish him
		if ( !validation ) {
			return middleware.applyPunishment(rule, next);
		}
	}

	next();
})

export default router;