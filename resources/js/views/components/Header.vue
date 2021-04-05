<template>
<header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            EXAM ONLINE
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item" >
                <div v-if="!isLoggedIn">
                    <router-link :to="{name: 'login'}" class="btn btn-primary btn-sm d-inline-block">Login</router-link>
                    <router-link :to="{name: 'register'}" class="btn btn-light btn-sm d-inline-block">Register</router-link>
                </div>
            </div>
            <div class="nav-item dropdown" v-if="isLoggedIn">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <div class="d-none d-xl-block ps-2">
                        <div>{{user.name}}</div>
                        <div class="mt-1 small text-muted">
                            <span class="badge bg-green position-relative" style="top:.25rem; right: .25rem"></span> Online
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <router-link :to="{name: 'settings'}" class="dropdown-item">Settings</router-link>
                    <a @click.prevent="logout()" href="#" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu" >
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav" v-if="isLoggedIn">
                    <li class="nav-item">
                        <router-link :to="{name: 'home'}" class="nav-link">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                            </span>
                            <span class="nav-link-title">
                              Home
                            </span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'subjects.index'}" class="nav-link">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" /></svg>
                            </span>
                            <span class="nav-link-title">
                              Subjects
                            </span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'exams.index'}" class="nav-link">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                            </span>
                            <span class="nav-link-title">
                              Exams
                            </span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    props: ['isLoggedIn', 'user', 'router'],
    methods: {
        ...mapActions([
            'logUserOut'
        ]),
        logout() {
            axios.post('logout').then(response => {
                this.logUserOut();
                this.router.push({ name: 'login' });
            })
        }
    }
}
</script>
