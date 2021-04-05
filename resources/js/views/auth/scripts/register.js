import PageHeader from '@/views/components/PageHeader';
import { mapActions } from 'vuex';
import Form from '@/helpers/Form';

export default {
    props: {
        router: Object,
        isLoggedIn: Boolean
    },
    data() {
        return {
            passwordVisibility: false,
            form: new Form({
                name: '',
                email: '',
                username: '',
                password: '',
            })
        }
    },
    components: {
        PageHeader
    },
    methods: {
        ...mapActions([
            'logUserIn'
        ]),
        register() {
            axios.get('/sanctum/csrf-cookie').then(payload => {
                axios.post('/register', this.form.data).then(payload => {
                    axios.get('/api/me').then(response => {
                        this.logUserIn(response.data.data);
                        this.router.push({ name:'home' });
                    });
                })
                .catch(payload => {
                    this.form.errors.record( payload.response.data.errors );
                });
            });
        }
    }
}