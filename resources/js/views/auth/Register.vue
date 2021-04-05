<template>
<div class="container-xl ">
    <div class="page-header text-white d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Register
                </div>
                <h2 class="page-title">
                    Create new account
                </h2>
            </div>
        </div>
    </div>
    <div class="container-tight py-6">
        <form @submit.prevent="register()" @keyup="form.errors.clear()" class="card card-md" autocomplete="off">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>
            <div class="mb-3">
              <label class="form-label">Name</label>
                <input name="name" type="text" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" placeholder="Enter name" v-model="form.data.name">
                <div  v-if="form.errors.get('name')" class="invalid-feedback">{{ form.errors.get('name') }}</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input name="username" type="text" :class="{ 'is-invalid': form.errors.has('username') }" class="form-control" placeholder="Enter username" v-model="form.data.username">
                <div  v-if="form.errors.get('username')" class="invalid-feedback">{{ form.errors.get('username') }}</div>
            </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
                <input name="email" type="email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" placeholder="Enter email" v-model="form.data.email">
                <div  v-if="form.errors.get('email')" class="invalid-feedback">{{ form.errors.get('email') }}</div>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group input-group-flat">
                <input name="password" :type="passwordVisibility ? 'text' :  'password'" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control"  placeholder="Password"  autocomplete="off" v-model="form.data.password">
                <span class="input-group-text">
                  <a @click.prevent="passwordVisibility = !passwordVisibility" href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
                <div  v-if="form.errors.get('password')" class="invalid-feedback">{{ form.errors.get('password') }}</div>
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <router-link :to="{name:'register'}">Sign in</router-link>
        </div>
    </div>
</div>
</template>

<script src="./scripts/register.js"></script>