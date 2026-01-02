<template>
    <div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Listing System Users</h4>
          <div class="col text-end">
             <router-link to="adduser">
                <button type="button" class="btn btn-success">+ Add user</button>
              </router-link>
          </div>
          </div>

       
       
      
  
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-striped mb-0">
              <thead class="table-dark">
                <tr>
                  <th>#ID</th>
                  <th>Account Name</th>
                  <th>Account Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="m in getallusersmodel" :key="m.id">
                  <td>{{ m.user_id }}</td>
                  <td>{{ m.username }}</td>
                   <td>{{ m.utype === 1 ? 'Super Admin' : m.utype === 2 ? 'Admin' : m.utype === 3 ? 'User' : 'Unknown' }}</td>
                  <td>
                    
                    <i class="ri-shield-fill"@click="permitionbnt(m.user_id)" title="Add permission"></i>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
  
          <!-- Pagination -->
          <nav class="dataTable-pagination">
            <Pagination :data="duesmodelpgin" :limit="5" @pagination-change-page="getallusersmodel" class="dataTable-pagination">
              <template #prev-nav>
                <span>Previous</span>
              </template>
              <template #next-nav>
                <span>Next</span>
              </template>
            </Pagination>
            Showing {{ duesmodelpgin.current_page }} of {{ duesmodelpgin.last_page }} Pages [ {{ duesmodelpgin.total }} Entries ]
          </nav>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, computed } from "vue";
  import { useMemberStores } from "../../store/members_store";
  import { storeToRefs } from 'pinia';
  import { useRouter } from "vue-router";
  import Auth from '../../store/auth.js';
  import { menustore } from "../../store/menus.js";
  
  const router = useRouter();
  
  //  Get menus from Auth store (backend after login)
  // const menus = Auth.getMenus();
  
  // Access user data and pagination from Pinia store
  const { getallusersmodel, duesmodelpgin,menuAccess } = storeToRefs(useMemberStores());
  const { getallusers } = useMemberStores();
  
  //  Load all users on mount
  getallusers();
  
  // Navigate to permission page
  const permitionbnt = (id) => {
    router.push(`/permission/${id}`);
  }
  
  // Computed property to check if "users" menu has menu_add permission
//   const canAdd= computed(() => {
//     const menu = menus.find(m => m.menu_name.toLowerCase() === 'users');
//     return menu ? menu.menu_add === 1 : false;
//   });
  </script>
  
  <style scoped>
  </style>
  