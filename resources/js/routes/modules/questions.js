import Create from '@/views/questions/Create';
import Edit from '@/views/questions/Edit';

export default [
	{
		path: '/questions/:id/edit',
		name: 'questions.edit',
		component: Edit,
		meta: {
			middlewares: ['auth']
		}
	},
	{
		path: '/exams/:id/questions/create',
		name: 'questions.create',
		component: Create,
		meta: {
			middlewares: ['auth']
		}
	}
];