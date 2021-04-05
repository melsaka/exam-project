<template>
<div class="container-xl ">
    <page-header pre="Exam" :title="exam.name">
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <router-link :to="{name:'questions.create', params:{id: this.examId} }" class="btn btn-primary d-none d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                New Question
              </router-link>
            </div>
        </div>
    </page-header>
    
    <div class="row justify-content-center">
        <div class="col-12">
            <ol class="breadcrumb breadcrumb-arrows mb-3" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'home'}" class="text-white">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'exams.index'}" class="text-white">Exams</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">{{exam.name}}</a>
                </li>
            </ol>
            <div class="card mb-3" v-for="question in questions.all()" :key="question.id">
                <div class="list-group-item">
                    <h3 class="row align-items-center">
                        <div class="col">
                            {{ question.body }}
                        </div>
                        <div class="col-auto">
                            <router-link :to="{name: 'questions.edit', params:{id: question.id}}" class="ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg> 
                            </router-link>
                            <a href="#" @click.prevent="deleteQuestion(question.id)" class="text-red">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </a>
                        </div>
                    </h3>
                </div>
                <div class="list-group list-group-flush list-group-hoverable">
                    <div class="list-group-item" v-for="answer in question.answers.data" :key="answer.id">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="badge" :class="[answer.status ? 'bg-green' : 'bg-red']"></span>
                            </div>
                            <div class="col text-truncate">
                                {{answer.body}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</template>

<script src="./scripts/show.js"></script>