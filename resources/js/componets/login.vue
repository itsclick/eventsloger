<template>

   <div class="auth-box overflow-hidden align-items-center d-flex">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-46 col-md-6 col-sm-8">
                        <div class="auth-brand text-center mb-4">
                            <a href="index.html" class="logo-dark">
                                <img src="@/assets/images/logo-black.png" alt="dark logo" />
                            </a>
                            <a href="index.html" class="logo-light">
                                <img src="@/assets/images/logo.png" alt="logo" />
                            </a>
                            <h4 class="fw-bold mt-3">Welcome</h4>
                            <p class="text-muted w-lg-75 mx-auto">Let’s get you signed in. Enter your email and password to continue.</p>
                        </div>

                        <div class="card p-4">
                           
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">
                                        Username
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control mb-2" placeholder="Username"  v-model="form.username"/>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">
                                        Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                       <input type="password" class="form-control mb-3" placeholder="Password" v-model="form.password" />
                                    </div>
                                </div>

                                <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input-light fs-14" type="checkbox" id="rememberMe" />
                                        <label class="form-check-label" for="rememberMe">Keep me signed in</label>
                                    </div>
                                    <a href="auth-reset-pass.html" class="text-decoration-underline link-offset-3 text-muted">Forgot Password?</a>
                                </div> -->

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary fw-semibold py-2" @click="login">Sign In</button>
                                </div>
                            

                            <p class="text-muted text-center mt-4 mb-0">
                                <!-- New here?
                                <a href="auth-sign-up.html" class="text-decoration-underline link-offset-3 fw-semibold">Create an account</a> -->
                            </p>
                        </div>

                        
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
          // response.data.permissions
        );
  
        // Redirect to dashboard
        router.push('/dashboard');
      })
      .catch(() => {
        alert('Invalid login credentials');
      });
  }
  </script>
  