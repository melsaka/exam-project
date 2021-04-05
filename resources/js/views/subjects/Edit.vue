<template>
<div class="container-xl ">
    <page-header pre="Edit" :title="'Subject: ' + form.data.name"></page-header>

    <div class="row justify-content-center">
        <div class="col-12" v-if="loaded">
            <ol class="breadcrumb breadcrumb-arrows mb-3" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'home'}" class="text-white">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'subjects.index'}" class="text-white">Subjects</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">{{ form.data.name }}</a>
                </li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success" role="alert" v-if="updated">
                        <h4 class="alert-title">Updated successfully!</h4>
                    </div>
                    <form @submit.prevent="updateSubject()" @keyup="updated = false">
                        <div class="form-group mb-3 ">
                            <label class="form-label">Name</label>
                            <div>
                                <input v-model="form.data.name" @keyup="form.errors.clear()" :class="{ 'is-invalid': form.errors.has('name') }" type="text" class="form-control" placeholder="Enter name">
                                <div class="invalid-feedback" v-if="form.errors.has('name')">
                                    {{form.errors.get('name')}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 ">
                            <label class="form-label">Description</label>
                            <div>
                                <textarea v-model="form.data.description" @keyup="form.errors.clear()" :class="{ 'is-invalid': form.errors.has('description') }" class="form-control" placeholder="Enter description"></textarea>
                                <div class="invalid-feedback" v-if="form.errors.has('description')">
                                    {{form.errors.get('description')}}
                                </div>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script src="./scripts/edit.js"></script>