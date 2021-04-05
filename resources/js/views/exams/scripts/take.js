import Api from '@/helpers/Api';
import Collection from '@/helpers/Collection';
import PageHeader from '@/views/components/PageHeader';

export default {
    data() {
        return {
            exam: {},
            submited: false,
            questions: new Collection,
            selection: new Collection
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
        selectAnswer(question, answer) {
            let selectedQuestion  = this.selection.get({question: question.id});

            if (selectedQuestion) {
                return selectedQuestion.answer = answer.id;
            }

            this.selection.add({
                question: question.id,
                answer: answer.id,
                rightAnswer: this.getRightAnswer(question)
            });
        },

        isAnswerSelected(answer) {
            return this.selection.get({answer: answer.id}) ? true : false ;
        },

        getAnswerClass(question, answer) {
            let selection  = this.selection.get({question: question.id});

            if (!selection) {
                return '';
            }

            if (answer.id == selection.rightAnswer) {
                return 'btn-success';
            }

            if (answer.id == selection.answer) {
                return 'btn-danger';
            }

            return '';
        },

        getRightAnswer(question) {
            let questionAnswers = new Collection;
            questionAnswers.set(this.questions.get({id: question.id}).answers.data);
            let rightAnswer = questionAnswers.get({status: true});
            return rightAnswer ? rightAnswer.id : 0;
        }
    },
    components: {
        PageHeader
    }
}