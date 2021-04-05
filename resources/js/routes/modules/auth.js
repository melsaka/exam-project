import Login from '@/views/auth/Login';
import Register from '@/views/auth/Register';

export default [
	{
		path: '/login',
		name: 'login',
		component: Login,
		meta: {
			middlewares: ['guest']
		}
	},
	{
		path: '/register',
		name: 'register',
		component: Register,
		meta: {
			middlewares: ['guest']
		}
	}
];