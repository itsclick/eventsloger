<template>
    
    <div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h4 class="card-title">User's List</h4>
            </div>
            <div class="col text-end">
              <router-link to="/addgroup">
                <button type="button" class="btn btn-success">+ Add user</button>
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
                  <th>Account Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="m in getallusersmodel" :key="m.id">
                
                 
                  <td>{{ m.user_id }}</td>
                  <td>{{ m.username }}</td>
                        <td>

                        <i class="fas fas fa-shield-alt fs-16 me-1" @click="permitionbnt(m.user_id)" title="Add permission"></i>  &nbsp;

                        
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
  
          <!-- Pagination -->
          <nav class="dataTable-pagination">
        <Pagination :data="duesmodelpgin"  :limit="5" @pagination-change-page="getallusersmodel" class="dataTable-pagination">
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
  import { useRouter } from "vue-router";
const router = useRouter();
  



  //varibale here
  const { getallusersmodel,duesmodelpgin } = storeToRefs(useMemberStores());

  //functions below
  const { getallusers } = useMemberStores();
  
 
 


  getallusers();

  const permitionbnt = (id) =>{
    router.push(`/permission/${id}`);
}


 

  
  
  
  
  </script>
  
  <style scoped>


  </style>
  