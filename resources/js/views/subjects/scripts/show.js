import ExamComponent from '@/views/components/Exams/Single';
import PageHeader from '@/views/components/PageHeader';
import Collection from '@/helpers/Collection';
import Api from '@/helpers/Api';

export default {
    data() {
        return {
            subject: {},
            exams: new Collection,
        }
    },
    computed: {
        subjectId() {
            return this.$route.params.id;
        }
    },
    created() {
        Api.get(`/api/subjects/${this.subjectId}`)
            .then(response => this.subject = response.data);

        Api.get(`/api/subjects/${this.subjectId}/relationships/exams?sort=-id&count=questions`)
            .then(response => this.exams.set(response.data, response.links, response.meta));
    },
    methods: {
        deleteExam(id) {
            Api.delete(`/api/exams/${id}`)
                .then(response => this.exams.delete({id: id}));
        }
    },
    components: {
        ExamComponent,
        PageHeader
    }
}