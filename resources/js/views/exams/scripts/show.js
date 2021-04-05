import Api from '@/helpers/Api';
import Collection from '@/helpers/Collection';
import PageHeader from '@/views/components/PageHeader';

export default {
    data() {
        return {
            exam: {},
            questions: new Collection
        }
    },
    computed: {
        examId() {
            return this.$route.params.id;
        }
    },
    created() {
        Api.get(`/api/exams/${this.examId}`)
            .then(response => this.exam = response.data);

        Api.get(`/api/exams/${this.examId}/relationships/questions?include=answers`)
            .then(response => this.questions.set(response.data));
    },
    methods: {
        deleteQuestion(id) {
            Api.delete(`/api/questions/${id}`)
                .then(response => this.questions.delete({id: id}));
        }
    },
    components: {
        PageHeader
    }
}