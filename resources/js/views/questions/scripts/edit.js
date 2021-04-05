
import PageHeader from '@/views/components/PageHeader';
import Collection from '@/helpers/Collection';
import Form from '@/helpers/Form';
import Api from '@/helpers/Api';

export default {
    data() {
        return {
            exam: {},
            updated: false,
            answers: new Collection,
            statusOptions: ['wrong', 'right'],
            answer: new Form({
                body: '',
                status: 'wrong'
            }),
            question: new Form({
                body: ''
            }),
        }
    },
    computed: {
        questionId() {
            return this.$route.params.id;
        }
    },
    created() {
        Api.get(`/api/questions/${this.questionId}?include=exam,answers`)
            .then(response => {
                this.question.assign(response.data);
                this.exam = response.data.exam.data;
                this.answers.set(response.data.answers.data);
                this.answers.all().forEach(answer => {
                    answer.status ? this.statusOptions = ['wrong'] : '';
                });
            });
    },
    methods: {
        updateQuestion() {
            this.question
                .patch(`/api/questions/${this.questionId}`)
                .then(response => {
                    this.question.assign(response.data)
                    this.updated = true;
                });
        },

        createAnswer() {
            this.answer
                .post(`/api/questions/${this.questionId}/answers`)
                .then(response => {
                    let answer = response.data;
                    
                    this.answers.add(answer);
                    
                    answer.status ? this.statusOptions = ['wrong'] : '';

                    this.answer.set('status', 'wrong');
                });
        },

        deleteAnswer(id) {
            Api.delete(`/api/questions/${this.questionId}/answers/${id}`)
                .then(response => {
                    let answer = this.answers.get({id: id});
                    
                    this.statusOptions = answer.status ? ['wrong', 'right'] : ['wrong'];

                    this.answers.delete({id: id});
                });
        }
    },
    components: {
        PageHeader
    },
}