import Index from '@/views/exams/Index';
import Show from '@/views/exams/Show';
import Edit from '@/views/exams/Edit';
import Take from '@/views/exams/Take';

export default [
	{
		path: '/exams',
		name: 'exams.index',
		component: Index,
		meta: {
			middlewares: ['auth']
		}
	},
	{
		path: '/exams/:id',
		name: 'exams.show',
		component: Show,
		meta: {
			middlewares: ['auth']
		}
	},
	{
		path: '/exams/:id/edit',
		name: 'exams.edit',
		component: Edit,
		meta: {
			middlewares: ['auth']
		}
	},
	{
		path: '/exams/:id/take',
		name: 'exams.take',
		component: Take,
		meta: {
			middlewares: ['auth']
		}
	}
];