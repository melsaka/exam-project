<template>
<div class="container-xl ">
    <page-header pre="Question" :title="question.get('body')"></page-header>

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
                    <a href="#">Edit Question</a>
                </li>
            </ol>

            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success" role="alert" v-if="updated">
                        <h4 class="alert-title">Updated successfully!</h4>
                    </div>
                    <form @submit.prevent="updateQuestion()" @keyup="updated = false">
                        <div class="form-group mb-3 ">
                            <label class="form-label">Question</label>
                            <div>
                                <textarea   v-model="question.data.body"
                                            @keyup="question.errors.clear()"
                                            placeholder="Enter Question"
                                            class="form-control"
                                            :class="{ 'is-invalid': question.errors.has('body') }"></textarea>

                                <div class="invalid-feedback" v-if="question.errors.has('body')">
                                    {{ question.errors.get('body') }}
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
                                {{ answer.body }}
                                <a @click.prevent="deleteAnswer(answer.id)" href="#" class="text-red">Delete</a>
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

   <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="createAnswer()">
                        <div class="form-group mb-3 ">
                            <label class="form-label">Answer</label>
                            <div>
                                <textarea   v-model="answer.data.body" 
                                            @keyup="answer.errors.clear()" 
                                            :class="{ 'is-invalid': answer.errors.has('body') }" 
                                            class="form-control" 
                                            placeholder="Enter Answer"></textarea>
                                            
                                <div class="invalid-feedback" v-if="answer.errors.has('body')">
                                    {{answer.errors.get('body')}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 ">
                            <label class="form-label">Status</label>
                            <div>
                                <select v-model="answer.data.status" class="form-control" :class="{ 'is-invalid': answer.errors.has('status') }">
                                    <option v-for="option in statusOptions" :value="option">{{option}}</option>
                                </select>
                                <div class="invalid-feedback" v-if="answer.errors.has('status')">
                                    {{answer.errors.get('status')}}
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

<script src="./scripts/edit.js"></script>
