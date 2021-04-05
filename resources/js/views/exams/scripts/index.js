import CreateComponent from '@/views/components/Exams/Create';
import ExamComponent from '@/views/components/Exams/Single';
import PageHeader from '@/views/components/PageHeader';
import Collection from '@/helpers/Collection';
import Api from '@/helpers/Api';

export default {
    data() {
        return {
            subjects: new Collection,
            exams: new Collection,
        }
    },
    created() {
        Api.get('/api/exams?sort=-id&count=questions')
            .then(response => this.exams.set(response.data, response.links, response.meta));

        Api.get('/api/subjects?sort=-id')
            .then(response => this.subjects.set(response.data));
    },
    methods: {
        addExam(exam) {
            this.exams.add(exam);
        },
        deleteExam(id) {
            Api.delete(`/api/exams/${id}`)
                .then(response => this.exams.delete({id: id}));
        }
    },
    components: {
        CreateComponent,
        ExamComponent,
        PageHeader
    }
}