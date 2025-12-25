<template>
<!doctype html>
<html lang="en">



<body>
    <!-- Begin page -->
    <div class="wrapper">
        <header class="app-topbar">
            <div class="container-fluid topbar-menu">
                <div class="d-flex align-items-center gap-2">
                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="index.html" class="logo-light">
                            <span class="logo-lg">
                               
                            </span>
                            <span class="logo-sm">
                                <img src="@/assets/images/logo-sm.png" alt="small logo" />
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="index.html" class="logo-dark">
                            <span class="logo-lg">
                                <img src="@/assets/images/logo-black.png" alt="dark logo" />
                            </span>
                            <span class="logo-sm">
                                <img src="@/assets/images/logo-sm.png" alt="small logo" />
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="sidenav-toggle-button btn btn-primary btn-icon">
                        <i class="ri ri-menu-line"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu">
                        <i class="ri ri-menu-line"></i>
                    </button>

                    

                   

                    
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" type="button">
                            <i class="ri ri-settings-2-line topbar-link-icon"></i>
                        </button>
                    </div>

                    <div id="theme-toggler" class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link" id="light-dark-mode" type="button">
                            <i class="ri ri-moon-line topbar-link-icon mode-light-moon"></i>
                            <i class="ri ri-sun-line topbar-link-icon mode-light-sun"></i>
                        </button>
                    </div>

                    

                    <div id="notification-dropdown-people" class="topbar-item">
                        <div class="dropdown">
                            <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown" type="button" data-bs-auto-close="outside" aria-haspopup="false" aria-expanded="false">
                                <i class="ri ri-notification-3-line topbar-link-icon animate-ring"></i>
                                <span class="badge text-bg-danger badge-circle topbar-badge">5</span>
                            </button>

                            <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                <div class="px-3 py-2 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-md fw-semibold">Notifications</h6>
                                        </div>
                                        <div class="col text-end">
                                            <a href="#!" class="badge badge-soft-success badge-label py-1">07 Notifications</a>
                                        </div>
                                    </div>
                                </div>

                                <div style="max-height: 300px" data-simplebar="">
                                    <!-- Notification 1 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-1">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="@/assets/images/users/user-4.jpg" class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span class="position-absolute rounded-pill bg-success notification-badge">
                                                    <i class="ri ri-notification-3-line align-middle"></i>
                                                    <span class="visually-hidden">unread notification</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Emily Johnson</span>
                                                commented on a task in
                                                <span class="fw-medium text-body">Design Sprint</span>
                                                <br />
                                                <span class="fs-xs">12 minutes ago</span>
                                            </span>
                                            <button type="button" class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn" data-dismissible="#message-1">
                                                <i class="ri ri-close-circle-line fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 2 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-2">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="@/assets/images/users/user-5.jpg" class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span class="position-absolute rounded-pill bg-info notification-badge">
                                                    <i class="ri ri-upload-cloud-2-line align-middle"></i>
                                                    <span class="visually-hidden">upload notification</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Michael Lee</span>
                                                uploaded files to
                                                <span class="fw-medium text-body">Marketing Assets</span>
                                                <br />
                                                <span class="fs-xs">25 minutes ago</span>
                                            </span>
                                            <button type="button" class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn" data-dismissible="#message-2">
                                                <i class="ri ri-close-circle-line fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 3 - Server CPU Alert -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-6">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <span class="avatar-md rounded-circle bg-light d-flex align-items-center justify-content-center">
                                                    <i class="ri ri-database-2-line fs-4"></i>
                                                </span>
                                                <span class="position-absolute rounded-pill bg-danger notification-badge">
                                                    <i class="ri ri-error-warning-line align-middle"></i>
                                                    <span class="visually-hidden">server alert</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Server #3</span>
                                                CPU usage exceeded 90%
                                                <br />
                                                <span class="fs-xs">Just now</span>
                                            </span>
                                            <button type="button" class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn" data-dismissible="#message-6">
                                                <i class="ri ri-close-circle-line fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 4 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-3">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="@/assets/images/users/user-6.jpg" class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span class="position-absolute rounded-pill bg-warning notification-badge">
                                                    <i class="ri ri-error-warning-line align-middle"></i>
                                                    <span class="visually-hidden">alert</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Sophia Ray</span>
                                                flagged an issue in
                                                <span class="fw-medium text-body">Bug Tracker</span>
                                                <br />
                                                <span class="fs-xs">40 minutes ago</span>
                                            </span>
                                            <button type="button" class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn" data-dismissible="#message-3">
                                                <i class="ri ri-close-circle-line fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 5 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-4">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="@/assets/images/users/user-7.jpg" class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span class="position-absolute rounded-pill bg-primary notification-badge">
                                                    <i class="ri ri-calendar-check-line align-middle"></i>
                                                    <span class="visually-hidden">event notification</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Welcome {{ username }} </span>
                                                scheduled a meeting for
                                                <span class="fw-medium text-body">UX Review</span>
                                                <br />
                                                <span class="fs-xs">1 hour ago</span>
                                            </span>
                                            <button type="button" class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn" data-dismissible="#message-4">
                                                <i class="ri ri-close-circle-line fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 6 -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-5">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <img src="@/assets/images/users/user-8.jpg" class="avatar-md rounded-circle" alt="User Avatar" />
                                                <span class="position-absolute rounded-pill bg-secondary notification-badge">
                                                    <i class="ri ri-edit-box-line align-middle"></i>
                                                    <span class="visually-hidden">edit</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Isabella White</span>
                                                updated the document in
                                                <span class="fw-medium text-body">Product Specs</span>
                                                <br />
                                                <span class="fs-xs">2 hours ago</span>
                                            </span>
                                            <button type="button" class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn" data-dismissible="#message-5">
                                                <i class="ri ri-close-circle-line fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>

                                    <!-- Notification 7 - Deployment Success -->
                                    <div class="dropdown-item notification-item py-2 text-wrap" id="message-7">
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="flex-shrink-0 position-relative">
                                                <span class="avatar-md rounded-circle bg-light d-flex align-items-center justify-content-center">
                                                    <i class="ri ri-rocket-line fs-4"></i>
                                                </span>
                                                <span class="position-absolute rounded-pill bg-success notification-badge">
                                                    <i class="ri ri-check-line align-middle"></i>
                                                    <span class="visually-hidden">deployment</span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1 text-muted">
                                                <span class="fw-medium text-body">Production Server</span>
                                                deployment completed successfully
                                                <br />
                                                <span class="fs-xs">30 minutes ago</span>
                                            </span>
                                            <button type="button" class="flex-shrink-0 text-muted btn btn-link p-0 position-absolute end-0 me-2 d-none noti-close-btn" data-dismissible="#message-7">
                                                <i class="ri ri-close-circle-line fs-xxl"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-reset text-decoration-underline link-offset-2 fw-bold notify-item border-top border-light py-2">Read All Messages</a>
                            </div>
                            <!-- End dropdown-menu -->
                        </div>
                        <!-- end dropdown-->
                    </div>

                    <div id="fullscreen-toggler" class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link" type="button" data-toggle="fullscreen">
                            <i class="ri ri-fullscreen-line topbar-link-icon"></i>
                            <i class="ri ri-fullscreen-exit-line topbar-link-icon d-none"></i>
                        </button>
                    </div>

                    <div id="simple-user-dropdown" class="topbar-item nav-user">
                        <div class="dropdown">
                            <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown" href="#!" aria-haspopup="false" aria-expanded="false">
                                <img src="@/assets/images/users/user-1.jpg" width="32" class="rounded-circle me-lg-2 d-flex" alt="user-image" />
                                <div class="d-lg-flex align-items-center gap-1 d-none">
                                    <h5 class="my-0">{{ username }}</h5>  
                                    <i class="ri ri-arrow-down-s-line align-middle"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- Header -->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome back!</h6>
                                </div>

                                <!-- My Profile -->
                                <a href="#!" class="dropdown-item">
                                    <i class="ri ri-user-line me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Profile</span>
                                </a>

                                <!-- Notifications -->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri ri-notification-3-line me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Notifications</span>
                                </a>

                                <!-- Wallet -->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri ri-bank-card-line me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">
                                        Balance:
                                        <span class="fw-semibold">$985.25</span>
                                    </span>
                                </a>

                                <!-- Settings -->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri ri-settings-line me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Account Settings</span>
                                </a>

                                <!-- Support -->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri ri-customer-service-line me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Support Center</span>
                                </a>

                                <!-- Divider -->
                                <div class="dropdown-divider"></div>

                                <!-- Lock -->
                                <a href="auth-lock-screen.html" class="dropdown-item">
                                    <i class="ri ri-lock-line me-1 fs-lg align-middle"></i>
                                    <span class="align-middle">Lock Screen</span>
                                </a>

                                <!-- Logout -->
                                <a href="" class="dropdown-item text-danger fw-semibold" @click="logout">
                                    <i class="ri ri-logout-box-line me-1 fs-lg align-middle" ></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Topbar End -->
 <div class="sidenav-menu">
    <!-- Brand Logo -->
    <a href="index.html" class="logo">
        <span class="logo logo-light">
            <span class="logo-lg"><img src="@/assets/images/logo.png" alt="logo" /></span>
            <span class="logo-sm"><img src="@/assets/images/logo-sm.png" alt="small logo" /></span>
        </span>

        <span class="logo logo-dark">
            <span class="logo-lg"><img src="@/assets/images/logo-black.png" alt="dark logo" /></span>
            <span class="logo-sm"><img src="@/assets/images/logo-sm.png" alt="small logo" /></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-on-hover">
        <i class="ri ri-circle-line align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    

    

        <!--- Sidenav Menu -->
        <div id="sidenav-menu">
            <ul class="side-nav">
                <li class="side-nav-title mt-2" data-lang="main">Main</li>
                <li class="side-nav-item">
                     <router-link to="/dashboard">
                    <span class="side-nav-link">
                        <span class="menu-icon"><i class="ri ri-dashboard-2-line"></i></span>
                        <span class="menu-text" data-lang="index">Dashboard</span>
                    </span>
                     </router-link>
                </li>
                <li class="side-nav-item" v-for="menu in menupermission" :key="menu.id">
                           <router-link :to="`/`+menu.menu_link">

                            <span class="side-nav-link">
                        <span class="menu-icon"><i class="ri-record-circle-line"></i></span>
                        <span class="menu-text" data-lang="apps-team-board">{{ menu.des }}</span>
                    </span>

                            </router-link>
                            </li>
                
                <li class="side-nav-item">
                    

                    <span class="side-nav-link">
                        <span class="menu-icon"><i class="ri ri-group-2-line"></i></span>
                        <span class="menu-text" data-lang="apps-team-board">Team Board</span>
                    </span>


                </li>
                <li class="side-nav-item">
                    <a href="apps-chat.html" class="side-nav-link">
                        <span class="menu-icon"><i class="ri ri-message-2-line"></i></span>
                        <span class="menu-text" data-lang="apps-chat">Chat</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="apps-calendar.html" class="side-nav-link">
                        <span class="menu-icon"><i class="ri ri-calendar-line"></i></span>
                        <span class="menu-text" data-lang="apps-calendar">Calendar</span>
                    </a>
                </li>
                
               
              
                
            </ul>
        </div>
    </div>
</div>
<!-- Sidenav Menu End -->

        <!-- ============================================================== -->
        <!-- Start Main Content -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="container-fluid">

                <div class="page-title-head d-flex align-items-center">
                    <div class="flex-grow-1">
                        <!-- <h4 class="page-main-title m-0">Welcome</h4> -->
                    </div>

                    <div class="text-end">
                       <!-- dfd -->
                    </div>
                </div>


              <router-view></router-view>
               

               


                
            </div>
            <!-- container -->

                <!-- Footer Start -->
                <footer class="footer">
                <div class="container-fluid">
                <div class="row">
                <div class="col-12 text-center">
                © Event Loger <span class="fw-semibold">Event Loger</span>
                </div>
                </div>
                </div>
                </footer>
                <!-- end Footer -->

        </div>

      

</body>

</html>
    
    </template>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <script setup>
    import { onMounted,ref} from "vue";
    import Auth from '../../store/auth.js';
    import { useRouter } from "vue-router";
    import { useMemberStores } from "../../store/members_store";
    import { storeToRefs } from 'pinia';
    import {menustore} from '../../store/menus.js';
   



  //functions below
  const {  memberstats } = useMemberStores();
 //viariables here
  const {  user_id,menupermission,getURL,getAccess,username } =storeToRefs(menustore());
  //functions below
  const { usermenumain } = menustore();



    const router = useRouter();
   

  
    memberstats();
   
    usermenumain();
    
  

function logout(){

    Auth.logout();
    window.location.href = "/login";
    
    
}


    
    </script>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <style lang="css" scoped>
    
    </style>