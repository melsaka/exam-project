<template>
<div class="container-xl ">
    <page-header pre="user" title="Settings"></page-header>
    <div class="row justify-content-center">
    	<div class="co-12">
    		<ol class="breadcrumb breadcrumb-arrows mb-5" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'home'}" class="text-white">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">Settings</a>
                </li>
            </ol>
            <form @submit.prevent="updateSettings()">
            	<div class="alert alert-success" role="alert" v-if="updated">
                    <h4 class="alert-title">Updated successfully!</h4>
                </div>
	          	<div class="mb-3">
	            	<label class="form-label">Name</label>
	            	<input v-model="form.data.name" type="text" class="form-control" name="example-text-input" placeholder="Your name">
	          	</div>
	          	<div class="mb-3">
	            	<label class="form-label">Username</label>
	            	<input v-model="form.data.username" type="text" class="form-control" name="example-text-input" placeholder="Your username">
	          	</div>
	          	<div class="mb-3">
	            	<label class="form-label">Email</label>
	            	<input v-model="form.data.email" type="text" class="form-control" name="example-text-input" placeholder="Your email">
	          	</div>
	          	<div class="mb-3">
		            <label class="form-label">Password</label>
		            <input v-model="form.data.password" type="password" class="form-control" name="example-password-input" placeholder="Your password">
	          	</div>
	          	<div class="mb-3">
	          		<button class="btn btn-primary">Update</button>
	          	</div>
          	</form>
      	</div>
    </div>
</div>
</template>

<script>
import PageHeader from '@/views/components/PageHeader';
import Form from '@/helpers/Form';
import Api from '@/helpers/Api';

export default {
	data() {
		return {
			updated: false,
			form: new Form({
				name: '',
				email: '',
				username: '',
				password: ''
			})
		}
	},
	created() {
		Api.get('/api/me').then(response => {
			this.form.assign(response.data);
		});
	},
	methods: {
		updateSettings() {
			this.form.patch('/api/settings')
				.then(response => this.updated = true);
		}
	},
	components: {
		PageHeader
	}
}
</script>