<template>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-4">
          <div class="card p-4">
  
            <h4 class="text-center mb-3">Login</h4>
  
            <input class="form-control mb-2" placeholder="Username"  v-model="form.username"/>
  
            <input type="password" class="form-control mb-3" placeholder="Password" v-model="form.password" />
  
            <button class="btn btn-primary w-100" @click="login"> Login </button>
  
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  import Auth from '@/store/auth';
  
  const router = useRouter();
  
  // Login form data
  const form = ref({
    username: '',
    password: ''
  });
  
  /**
   * Send login request to backend
   */
  function login() {
    axios.post('/api/users/login', form.value)
      .then(response => {
  
        // Save login info and permissions
        Auth.login(
          response.data.access_token,
          response.data.user,
          response.data.permissions
        );
  
        // Redirect to dashboard
        router.push('/dashboard');
      })
      .catch(() => {
        alert('Invalid login credentials');
      });
  }
  </script>
  