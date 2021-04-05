import SubjectComponent from '@/views/components/Subjects/Single';
import CreateComponent from '@/views/components/Subjects/Create';
import PageHeader from '@/views/components/PageHeader';
import Collection from '@/helpers/Collection';
import Api from '@/helpers/Api';

export default {
    data() {
        return {
            subjects: new Collection,
        }
    },
    created() {
        Api.get(`/api/subjects?sort=-id&count=exams`)
            .then(response => this.subjects.set(response.data));
    },
    methods: {
        addSubject(subject) {
            this.subjects.add(subject);
        },
        deleteSubject(id) {
            Api.delete(`/api/subjects/${id}`)
                .then(response => this.subjects.delete({id: id}));
        }
    },
    components: {
        CreateComponent,
        SubjectComponent,
        PageHeader
    }
}