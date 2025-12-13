<template>
    <!-- {{ sysmenus }} -->
    <div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h4 class="card-title">Menu List</h4>
            </div>
            <div class="col text-end">
              <router-link to="/addmenu">
                <button type="button" class="btn btn-success">+ Add Menu</button>
              </router-link>
            </div>
          </div>
        </div>
  
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-striped mb-0">
              <thead class="table-dark">
                <tr>
                  
                  <th>#ID</th>
                  <th>Menu Name</th>
                  <th>Menu Route</th>
                  <th>Menu Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="m in sysmenus" :key="m.id">
                
                 
                  <td>{{ m.menu_id }}</td>
                  <td>{{ m.menu_name }}</td>
                  <td>{{ m.menu_link }}</td>
                  <td>{{ m.des }}</td>
                
                        <td>

                       

                        <i class="fas fa-trash 16-18 me-1 " @click="deletemenubtn(m.id)" title="Delete"></i> 
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
  
          <!-- Pagination -->
          <nav class="dataTable-pagination">
        <Pagination :data="duesmodelpgin"  :limit="5" @pagination-change-page="getallsysmenus" class="dataTable-pagination">
            <template #prev-nav>
                <span>Previous</span>
            </template>
            <template #next-nav>
                <span>Next</span>
               
            </template>
           
        </Pagination>
        Showing{{ duesmodelpgin.current_page }} of {{ duesmodelpgin.last_page }} Pages [ {{ duesmodelpgin.total }} Entries ]
        </nav>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
 import { onMounted } from "vue";
  import { useMemberStores } from "../../store/members_store";
  import { storeToRefs } from 'pinia';
  



  //varibale here
  const { sysmenus ,duesmodelpgin,getgroupbyid} = storeToRefs(useMemberStores());

  //functions below
  const { getallsysmenus, deletemenubtn  } = useMemberStores();
  
 
 


  getallsysmenus();

  
  
  
  
  </script>
  
  <style scoped>


  </style>
  