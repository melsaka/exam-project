import Index from '@/views/subjects/Index';
import Edit from '@/views/subjects/Edit';
import Show from '@/views/subjects/Show';

export default [
	{
		path: '/subjects',
		name: 'subjects.index',
		component: Index,
		meta: {
			middlewares: ['auth']
		}
	},
	{
		path: '/subjects/:id',
		name: 'subjects.show',
		component: Show,
		meta: {
			middlewares: ['auth']
		}
	},
	{
		path: '/subjects/:id/edit',
		name: 'subjects.edit',
		component: Edit,
		meta: {
			middlewares: ['auth']
		}
	}
];