<template>
<div class="container-xl ">
    <page-header pre="Login" title="Login with your credentials"></page-header>

    <div class="container-tight py-6">
        <form @submit.prevent="login()" @keyup="form.errors.clear()" class="card card-md" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login to your account</h2>
                <div class="alert alert-danger" role="alert" v-if="form.errors.has('username')">
                    <h4 class="alert-title">I'm sorry&hellip;</h4>
                    <div class="text-muted">{{ form.errors.get('username') }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input name="username" type="text" :class="{ 'is-invalid': form.errors.has('username') }" class="form-control" placeholder="Enter username" v-model="form.data.username">
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                        <span class="form-label-description">
                            <a href="./forgot-password.html">I forgot password</a>
                        </span>
                    </label>
                    <div class="input-group input-group-flat">
                        <input name="password" :type="passwordVisibility ? 'text' :  'password'" class="form-control"  placeholder="Password"  autocomplete="off" v-model="form.data.password">
                        <span class="input-group-text">
                            <a @click.prevent="passwordVisibility = !passwordVisibility" href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input @click="form.data.remember = !form.data.remember" name="remember" type="checkbox" class="form-check-input"/>
                        <span class="form-check-label">Remember me on this device</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            Don't have account yet? <router-link :to="{name: 'regsiter'}">Sign up</router-link>
        </div>
    </div>
</div>
</template>

<script src="./scripts/login.js"></script>