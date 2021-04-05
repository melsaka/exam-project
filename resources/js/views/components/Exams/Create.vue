<template>
<div class="col-md-4 col-12">
    <div class="card">
        <div class="card-body">
            <div class="card-body">
                <form @submit.prevent="createExam()" @keyup="form.errors.clear()">
                    <div class="form-group mb-3 ">
                        <label class="form-label">Subject</label>
                        <div>
                            <select class="form-control" v-model="form.data.subject_id" :class="{ 'is-invalid': form.errors.has('subject_id') }">
                                <option value="0">Please select subject</option>
                                <option v-for="subject in subjects.all()" :key="subject.id" :value="subject.id">{{ subject.name }}</option>
                            </select>
                            <div class="invalid-feedback" v-if="form.errors.has('subject_id')">
                                {{form.errors.get('subject_id')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3 ">
                        <label class="form-label">Name</label>
                        <div>
                            <input v-model="form.data.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" class="form-control" placeholder="Enter name">
                            <div class="invalid-feedback" v-if="form.errors.has('name')">
                                {{form.errors.get('name')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3 ">
                        <label class="form-label">Description</label>
                        <div>
                            <textarea v-model="form.data.description" :class="{ 'is-invalid': form.errors.has('description') }" class="form-control" placeholder="Enter description"></textarea>
                            <div class="invalid-feedback" v-if="form.errors.has('description')">
                                {{form.errors.get('description')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import Form from '@/helpers/Form';
export default {
    props:['subjects'],
    data() {
        return {
            form: new Form({
                subject_id: 0,
                name: '',
                description: ''
            })
        }
    },
    methods: {
        createExam() {
            this.form
                .post('api/exams')
                .then(response => this.$emit('examCreated', response.data));
        }
    }
}
</script>