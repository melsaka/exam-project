
import PageHeader from '@/views/components/PageHeader';
import Collection from '@/helpers/Collection';
import Form from '@/helpers/Form';
import Api from '@/helpers/Api';

export default {
    data() {
        return {
            question: {body: 'Here goes your question?'},
            exam: {},
            answers: new Collection,
            statusOptions: ['wrong', 'right'],
            form: new Form({
                body: ''
            })
        }
    },
    computed: {
        examId() {
            return this.$route.params.id;
        }
    },
    created() {
        Api.get(`/api/exams/${this.examId}`)
            .then(response => {
                this.exam = response.data;
                this.form.set('exam_id', this.exam.id);
            });
    },
    methods: {
        createQuestion() {
            this.form
                .post('/api/questions')
                .then(response => {
                    this.question = response.data;
                    this.form.set('status', 'wrong');
                });
        },

        createAnswer() {
            this.form
                .post(`/api/questions/${this.question.id}/answers`)
                .then(response => {
                    let answer = response.data;

                    this.answers.add(answer);

                    answer.status ? this.statusOptions = ['wrong'] : '';
                    
                    this.form.set('status', 'wrong');
                });
        }
    },
    components: {
        PageHeader
    }
}