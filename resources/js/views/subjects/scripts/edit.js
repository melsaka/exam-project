import PageHeader from '@/views/components/PageHeader';
import Form from '@/helpers/Form';
import Api from '@/helpers/Api';

export default {
    data() {
        return {
            loaded: false,
            updated: false,
            form: new Form({
                name: '', 
                description: ''
            })
        }
    },
    computed: {
        subjectId() {
            return this.$route.params.id;  
        } 
    },
    created() {
        Api.get(`/api/subjects/${this.subjectId}`)
            .then(response => {
                this.form.assign(response.data);
                this.loaded = true;
            });
    },
    methods: {
        updateSubject() {
            this.form
                .patch(`/api/subjects/${this.subjectId}`)
                .then(response => this.updated = true);
        }
    },
    components: {
        PageHeader,
    }
}
