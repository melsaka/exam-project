<template>
<div class="container-xl ">
    <page-header pre="Subject" :title="subject.name"></page-header>

    <div class="row justify-content-center">
        <div class="col-12">
            <ol class="breadcrumb breadcrumb-arrows mb-3" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'home'}" class="text-white">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'subjects.index'}" class="text-white">Subjects</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">{{subject.name}}</a>
                </li>
            </ol>
            <div class="card" v-if="exams.empty()">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="skeleton-avatar"></div>
                        </div>
                        <div class="col">
                            <div class="skeleton-line"></div>
                            <div class="skeleton-line"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" v-if="exams.any()">
                <div class="card-body">
                    <div class="divide-y-4">
                        <exam-component v-for="exam in exams.all()" :key="exam.id" :exam="exam" @deleteExam="deleteExam" />
                    </div>
                </div>
            </div>
            <div class="card" v-if="exams.isNextLink()">
                <a href="#" @click.prevent="exams.loadMore()" class="btn btn-primary">Loadmore</a>
            </div>
        </div>

    </div>
</div>
</template>

<script src="./scripts/show.js"></script>
