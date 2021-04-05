<template>
<div class="container-xl ">
    <page-header pre="All" title="Subjects"></page-header>

    <div class="row justify-content-center">
        
        <create-component @subjectCreated="addSubject" />

        <div class="col-12 col-md-8">
            <ol class="breadcrumb breadcrumb-arrows mb-3" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'home'}" class="text-white">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">Subjects</a>
                </li>
            </ol>
            <div class="card" v-if="subjects.empty()">
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
            <div class="card" v-if="subjects.any()">
                <div class="card-body">
                    <div class="divide-y-4">
                        <subject-component v-for="subject in subjects.all()" :key="subject.id" :subject="subject" @deleteSubject="deleteSubject" />
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</template>

<script src="./scripts/index.js"></script>