<template>


    <!DOCTYPE html>
    <html lang="en" dir="ltr" data-startbar="dark" data-bs-theme="light">
    
    
   
    <head>
        
    
        <meta charset="utf-8" />
                <title>Rizz | Rizz - Admin & Dashboard Template</title>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
                <meta content="" name="author" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
                <!-- App favicon -->
                <link rel="shortcut icon" href="assets/images/favicon.ico">
    
           
    
        <link rel="stylesheet" href="assets/libs/jsvectormap/css/jsvectormap.min.css">
    
         <!-- App css -->
         <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
         <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
         <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
         
    
    </head>
    
    <body>
    
        <!-- Top Bar Start -->
        <div class="topbar d-print-none">
            <div class="container-xxl">
                <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">    
            
    
                    <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">                        
                        <li>
                            <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                                <i class="iconoir-menu-scale"></i>
                            </button>
                        </li> 
                        <li class="mx-3 welcome-text">
                            <h3 class="mb-0 fw-bold text-truncate">Welcome {{ fullname }}</h3>
                            
                            
                            <!-- <h6 class="mb-0 fw-normal text-muted text-truncate fs-14">Here's your overview this week.</h6> -->
                        </li>                   
                    </ul>
                    <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                        <li class="hide-phone app-search">
                            <form role="search" action="#" method="get">
                                <input type="search" name="search" class="form-control top-search mb-0" placeholder="Search here...">
                                <button type="submit"><i class="iconoir-search"></i></button>
                            </form>
                        </li>     
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <!-- <img src="assets/images/flags/us_flag.jpg" alt="" class="thumb-sm rounded-circle"> -->
                            </a>
                            <div class="dropdown-menu">
                                <!-- <a class="dropdown-item" href="#"><img src="assets/images/flags/us_flag.jpg" alt="" height="15" class="me-2">English</a>
                                <a class="dropdown-item" href="#"><img src="assets/images/flags/spain_flag.jpg" alt="" height="15" class="me-2">Spanish</a>
                                <a class="dropdown-item" href="#"><img src="assets/images/flags/germany_flag.jpg" alt="" height="15" class="me-2">German</a>
                                <a class="dropdown-item" href="#"><img src="assets/images/flags/french_flag.jpg" alt="" height="15" class="me-2">French</a> -->
                            </div>
                        </li><!--end topbar-language-->
            
                        <li class="topbar-item">
                            <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                                <font-awesome-icon icon="moon" class="dark-mode" />
    
                                <i class="icofont-moon dark-mode"></i>
                                <i class="icofont-sun light-mode"></i>
                            </a>                    
                        </li>
        
                        <li class="dropdown topbar-item">
                            <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <i class="icofont-bell-alt"></i>
                                <span class="alert-badge"></span>
                            </a>
                            
                        </li>
        
                        <li class="dropdown topbar-item">
                            <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <!-- <img src="assets/images/users/avatar-1.jpg" alt="" class="thumb-lg rounded-circle"> -->
                                <i class="iconoir-user h1 align-self-center mb-0 text-secondary"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end py-0">
                                <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                                    <div class="flex-shrink-0">
                                        <!-- <img src="assets/images/users/avatar-1.jpg" alt="" class="thumb-md rounded-circle"> -->
                                    </div>
                                    <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                        <h6 class="my-0 fw-medium text-dark fs-13">{{ fullname }}</h6>
                                        <small class="text-muted mb-0">You are active</small>
                                    </div><!--end media-body-->
                                </div>
                                <div class="dropdown-divider mt-0"></div>
                                <small class="text-muted px-2 pb-1 d-block">Account</small>
                                <a class="dropdown-item" href="pages-profile.html"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>
                                <a class="dropdown-item" href="pages-faq.html"><i class="las la-wallet fs-18 me-1 align-text-bottom"></i> Earning</a>
                                <small class="text-muted px-2 py-1 d-block">Settings</small>                        
                                <a class="dropdown-item" href="pages-profile.html"><i class="las la-cog fs-18 me-1 align-text-bottom"></i>Account Settings</a>
                                <a class="dropdown-item" href="pages-profile.html"><i class="las la-lock fs-18 me-1 align-text-bottom"></i> Security</a>
                                <a class="dropdown-item" href="pages-faq.html"><i class="las la-question-circle fs-18 me-1 align-text-bottom"></i> Help Center</a>                       
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item text-danger" href="#" @click="logout"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
                            </div>
                        </li>
                    </ul><!--end topbar-nav-->
                </nav>
                <!-- end navbar-->
            </div>
        </div>
        <!-- Top Bar End -->
        <!-- leftbar-tab-menu -->
        <div class="startbar d-print-none">
            <!--start brand-->
            <div class="brand">
                <a href="index.html" class="logo">
                    <span>
                        <div class="logo-container">
    <img src="/public/assets/images/logo-dark.png" alt="Logo" />
  </div>
                    </span>
                    <span class="">
                        <div class="logo-container">
    <img src="/public/assets/images/logo-dark.png" alt="Logo" />
  </div>
                    </span>
                </a>
            </div>
            <!--end brand-->
            <!--start startbar-menu-->
            <div class="startbar-menu" >
                <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                    <div class="d-flex align-items-start flex-column w-100">
                        <!-- Navigation -->
                        <ul class="navbar-nav mb-auto w-100">
                            <li class="menu-label pt-0 mt-0">
                                <!-- <small class="label-border">
                                    <div class="border_left hidden-xs"></div>
                                    <div class="border_right"></div>
                                </small> -->
                                <span>Main Menu</span>
                            </li>
                           

                           

                            <li class="nav-item">

                                <router-link to="/dashboard">
                                    <span class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarElements">
                                    <i class="iconoir-home-simple menu-icon"></i>
                                    <span>Dashboards</span>
                                    </span>
                                    
                                    
                               
                                </router-link>
                                
                                
                                
                            </li>


                            
                           
                                   

                                    <!-- Loop through allowed menus only -->
                                    


                                   
                                    
                                    <li class="nav-item" v-for="menu in menus" :key="menu.id">
                           <router-link :to="menu.menu_link">
                                <span class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarElements" >
                                    <i class="iconoir-home-simple menu-icon"></i>
                                <span>{{ menu.des }}</span>
                                </span>
                            </router-link>
                            </li>



                               


                            
                            
                            
                           
                            
                           
                            
                            
                          
                            
                        
                        </ul><!--end navbar-nav--->
                        <div class="update-msg text-center"> 
                            <div class="d-flex justify-content-center align-items-center thumb-lg update-icon-box  rounded-circle mx-auto">
                                <i class="iconoir-peace-hand h3 align-self-center mb-0 text-primary"></i>
                            </div>              
                            <h5 class="mt-3">24/7 Support</h5>
                            <p class="mb-3 text-muted">info@fokastec.com</p>
                            <a href="https://wa.link/vvqhpd" class="btn text-primary shadow-sm rounded-pill">Whatsapp us</a>
                        </div>
                    </div>
                </div><!--end startbar-collapse-->
            </div><!--end startbar-menu-->    
        </div><!--end startbar-->
        <div class="startbar-overlay d-print-none"></div>
        <!-- end leftbar-tab-menu-->
    
                <div class="page-wrapper">
    
                <div class="page-content">
                <div class="container">
    
                <router-view></router-view>
               
    
                </div>
    
                </div>
    
            
    
    
    
    
    
        </div>
        <!-- end page-wrapper -->
    
        <!-- Javascript  -->
        <!-- vendor js -->
        
     
    </body>
    <!--end body-->
    
    
    
    </html>
    
    </template>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <script setup>
    import { onMounted,ref} from "vue";
    import Auth from '../../store/auth.js';
    import { useRouter } from "vue-router";
    import { useMemberStores } from "../../store/members_store";
    import { storeToRefs } from 'pinia';
   


  //varibale here
  const {  sysmenus } =storeToRefs(useMemberStores());


  //functions below
  const {  memberstats ,getallsysmenus} = useMemberStores();
 

    const router = useRouter();
   

// Get allowed menus
const menus = Auth.getMenus();

    const fullname=ref(Auth.user.username)

  
    memberstats();
    getallsysmenus();

function logout(){

    Auth.logout();
    window.location.href = "/login";
    
    
}
    
    </script>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <style lang="css" scoped>
    
    </style>