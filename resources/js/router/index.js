

import { createRouter, createWebHistory } from 'vue-router';

import login from '../componets/login.vue';
import Auth from '../store/auth.js';
import page404 from '../componets/page404.vue';
import mainlayout from '../componets/layouts/main.vue';
import statdasboard from '../componets/pages/dashboard.vue';
import members_list from '../componets/pages/members_list.vue';
import add_member from '../componets/pages/add_member.vue';
import dues_list from '../componets/pages/dues_list.vue';
import group_list from '../componets/pages/group_list.vue';
import paddues from '../componets/pages/paydues.vue';
import add_group from '../componets/pages/add_group.vue';
import editmember from '../componets/pages/editmember.vue';
import editdues from '../componets/pages/editdues.vue';
import editgroup from '../componets/pages/editgroup.vue';






// import members_list from '../componets/members_list.vue';
// import dues_list from '../componets/dues_list.vue';
// import group_list from '../componets/group_list.vue';
// import stats from '../componets/stats.vue'


// 
// import paddues from '../componets/paydues.vue';
// 
// 



// function routeLoad(view){
//     return() => import(`../components/${view}.vue`)
// }statdasboard


const routes=[

    {path:'/',name:'login',component:login},
    {path:'/login',name:'mainlogin',component:login},



    {path:'/dashboard',name:'mainlayout',component:mainlayout,meta: { requiresAuth: true},
    children:[
         {path:'',name:'statdasboard',component:statdasboard},
        {path:'/members',name:'members',component:members_list,meta: { requiresAuth: true}},
        {path:'/addmember',name:'addmember',component:add_member,meta: { requiresAuth: true}},
        {path:'/dues',name:'dues',component:dues_list,meta: { requiresAuth: true}},
        {path:'/groups',name:'groups',component:group_list,meta: { requiresAuth: true}},
        {path:'/paddues/:id',name:'paddues',component:paddues,props:true,meta: { requiresAuth: true}},
        {path:'/adddues',name:'adddues',component:members_list,meta: { requiresAuth: true}},
        {path:'/addgroup',name:'addgroup',component:add_group,meta: { requiresAuth: true}},
        {path:'/editmember/:id',name:'editmember',component:editmember,meta: { requiresAuth: true},props:true},
        {path:'/editdues/:id',name:'editdues',component:editdues,props:true,meta: { requiresAuth: true}},
        {path:'/editgroup/:id',name:'editgroup',component:editgroup,props:true,meta: { requiresAuth: true}},




     
    
    
    ]},










    // {path:'/',name:'stats',component:stats,meta: { requiresAuth: true}},
    // {path:'/login',name:'login',component:login},
    // {path:'/members',name:'members',component:members_list,meta: { requiresAuth: true}},
    // {path:'/dues',name:'dues',component:dues_list,meta: { requiresAuth: true}},
    // 
    // {path:'/addmember',name:'addmember',component:add_member,meta: { requiresAuth: true}},
    // 
    // 
    // 
    // {path:'/editdues/:id',name:'editdues',component:editdues,props:true,meta: { requiresAuth: true}},
    // 

    

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