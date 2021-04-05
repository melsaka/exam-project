
import PageHeader from '@/views/components/PageHeader';
import Collection from '@/helpers/Collection';
import Form from '@/helpers/Form';
import Api from '@/helpers/Api';

export default {
    data() {
        return {
            updated: false,
            subjects: new Collection,
            form: new Form({
                name: '',
                description: '',
                subject_id: 0
            })
        }
    },
    computed: {
        examId() {
            return this.$route.params.id;
        }
    },
    components: {
        PageHeader
    },
    methods: {
        updateExam() {
            this.form
                .patch(`/api/exams/${this.examId}`)
                .then(response => this.updated = true);
        }
    },
    created() {
        Api.get('/api/subjects?sort=-id')
            .then(response => this.subjects.set(response.data));

        Api.get(`/api/exams/${this.examId}`)
            .then(response => this.form.assign(response.data));
    }
}