<template>
<div class="container-xl ">
    <page-header pre="Create" title="Question"></page-header>

    <div class="row justify-content-center mb-3">
        <div class="col-12">
            <ol class="breadcrumb breadcrumb-arrows mb-3" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'home'}" class="text-white">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'exams.index'}" class="text-white">Exams</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'exams.show', params: {id: exam.id}}" class="text-white">{{ exam.name }}</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">Create Question</a>
                </li>
            </ol>
        </div>
        <div class="col-12 mb-2" v-if="question.id">
             <span class="badge bg-dark mb-2">Question</span>
            <div class="card">
                <div class="card-body">
                    <h2>{{question.body}}</h2>
                </div>
            </div>
        </div>
        <div class="col-12" v-if="!question.id">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="createQuestion()">
                        <div class="form-group mb-3 ">
                            <label class="form-label">Question</label>
                            <div>
                                <textarea v-model="form.data.body" @keyup="form.errors.clear()" :class="{ 'is-invalid': form.errors.has('body') }" class="form-control" placeholder="Enter Question"></textarea>
                                <div class="invalid-feedback" v-if="form.errors.has('body')">
                                    {{form.errors.get('body')}}
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

    <div class="row justify-content-center mb-3" v-if="answers.any()">
        <div class="col-12 mb-2">
            <span class="badge bg-dark mb-2">Answers</span>
        </div>
        <div class="col-12" v-for="answer in answers.all()">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="font-weight-medium">
                                {{answer.body}}
                            </div>
                        </div>
                        <div class="col-auto align-self-center">
                            <span class="badge" :class="[answer.status ? 'bg-green' : 'bg-red']"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div class="row justify-content-center" v-if="question.id">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="createAnswer()">
                        <div class="form-group mb-3 ">
                            <label class="form-label">Answer</label>
                            <div>
                                <textarea v-model="form.data.body" @keyup="form.errors.clear()" :class="{ 'is-invalid': form.errors.has('body') }" class="form-control" placeholder="Enter Answer"></textarea>
                                <div class="invalid-feedback" v-if="form.errors.has('body')">
                                    {{form.errors.get('body')}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 ">
                            <label class="form-label">Status</label>
                            <div>
                                <select v-model="form.data.status" class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                    <option v-for="option in statusOptions" :value="option">{{option}}</option>
                                </select>
                                <div class="invalid-feedback" v-if="form.errors.has('status')">
                                    {{form.errors.get('status')}}
                                </div>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script src="./scripts/create.js"></script>
