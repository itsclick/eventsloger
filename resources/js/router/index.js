import { createRouter, createWebHistory } from 'vue-router';

import login from '../componets/login.vue';
import Auth from '../store/auth.js';
import page404 from '../componets/page404.vue';
import mainlayout from '../componets/layouts/main.vue';
import statdasboard from '../componets/pages/dashboard.vue';
import members_list from '../componets/pages/members_list.vue';
import paticipantdetails from '../componets/pages/particiapant_details.vue';
import adduser from '../componets/pages/add_user.vue';
import paddues from '../componets/pages/paydues.vue';
import add_group from '../componets/pages/add_group.vue';
import editEventbtn from '../componets/pages/edit_events.vue';
import eventform from '../componets/pages/event_form.vue';
import editgroup from '../componets/pages/editgroup.vue';
import users from '../componets/pages/users_list.vue';
import permission from '../componets/pages/permission.vue';
import menus from '../componets/pages/menu_list.vue';
import addmenu from '../componets/pages/add_menu.vue'
import evaddevents from '../componets/pages/event_list.vue';
import addeventbtn from '../componets/pages/add_events.vue';
import publicform from '../componets/pages/event_registration.vue';
import participants from '../componets/pages/paticipant_list.vue';













const routes=[

    {path:'/',name:'login',component:login},
    { path: '/login', name: 'mainlogin', component: login },
    { path: '/publicform/:id', name: 'publicform', component: publicform },



    {path:'/dashboard',name:'mainlayout',component:mainlayout,meta: { requiresAuth: true},
    children:[
         {path:'',name:'statdasboard',component:statdasboard},
        {path:'/addeventbtn',name:'addeventbtn',component:addeventbtn,meta: { requiresAuth: true}},
        {path:'/evaddevents',name:'evaddevents',component:evaddevents,meta: { requiresAuth: true}},
        {path:'/paticipantdetails/:eid',name:'paticipantdetails',component:paticipantdetails,meta: { requiresAuth: true}, props: true, },
        {path:'/paddues/:id',name:'paddues',component:paddues,props:true,meta: { requiresAuth: true}},
        {path:'/adddues',name:'adddues',component:members_list,meta: { requiresAuth: true}},
        {path:'/addgroup',name:'addgroup',component:add_group,meta: { requiresAuth: true}},
        {path:'/editEventbtn/:eid',name:'editEventbtn',component:editEventbtn,meta: { requiresAuth: true},props:true},
        {path:'/eventform/:id',name:'eventform',component:eventform,props:true,meta: { requiresAuth: true}},
        {path:'/editgroup/:id',name:'editgroup',component:editgroup,props:true,meta: { requiresAuth: true}},
        {path:'/users',name:'users',component:users,meta: { requiresAuth: true}},
        {path:'/permission/:user_id',name:'permission',component:permission,props:true,meta: { requiresAuth: true}},
        {path:'/menus',name:'menus',component:menus,meta: { requiresAuth: true}},
        { path: '/addmenu', name: 'addmenu', component: addmenu, meta: { requiresAuth: true } },
        { path: '/participants', name: 'participants', component: participants, meta: { requiresAuth: true } },
         {path:'/adduser',name:'adduser',component:adduser,meta: { requiresAuth: true}},







     
    
    
    ]},





    

    {
        path:'/:pathMatch(.*)*', name:'error', component: page404 
    },


];





const router = createRouter({
    history: createWebHistory(), 
    routes,
  });
  
  //Global beforeEach for auth
router.beforeEach((to, from, next) => {
    // Set page title (use VITE_APP_NAME from .env)
    const appName = import.meta.env.VITE_APP_NAME || 'My App';
    if (to.meta.title) {
        document.title = `${to.meta.title} - ${appName}`;
    }

    // Auth check
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (Auth.check()) {
            next();
        } else {
            next({ name: 'login' });
        }
    } else {
        next();
    }
});
  export default router;