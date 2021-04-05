<template>
<div class="col-12 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="card-body">
                <form @keyup="form.errors.clear()" @submit.prevent="createSubject()">
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
    data() {
        return {
            form: new Form({name: '', description: ''})
        }
    },
    methods: {
        createSubject() {
            this.form
                .post('api/subjects')
                .then(response => {
                    this.$emit('subjectCreated', response.data);
                });
        }
    }
}
</script>