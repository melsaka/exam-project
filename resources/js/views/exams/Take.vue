<template>
<div class="container-xl ">
    <page-header pre="Exam" :title="exam.name"></page-header>
    
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
                    </h3>
                </div>
                <div class="list-group list-group-flush list-group-hoverable">
                    <div class="list-group-item" v-for="answer in question.answers.data" :key="answer.id">
                        <div class="row align-items-center">
                            <div class="col text-truncate">
                                <button class="btn w-100" v-if="!submited" @click.prevent="selectAnswer(question, answer)" :class="{'btn-dark' : isAnswerSelected(answer)}">{{answer.body}}</button>
                                <button class="btn w-100" v-if="submited" :class="getAnswerClass(question, answer)">{{answer.body}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button class="btn btn-primary w-100" @click.prevent="submited = true">Submit</button>
        </div>
    </div>
</div>
</template>

<script src="./scripts/take.js"></script>